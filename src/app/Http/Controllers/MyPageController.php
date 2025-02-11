<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class MyPageController extends Controller
{
    public function index()
    {
        $reservations = $this->getReservationsByStatus('予約');
        $histories = $this->getReservationsByStatus('来店');

        $favorites = Auth::user()->favorites()
            ->pluck('shop_id')
            ->toArray();

        $shops = Shop::with(['area', 'genre'])
            ->whereIn('id', $favorites)
            ->get();
        $user = Auth::user();
        $userId = $user->id;
        $reviews = Review::where('user_id', $userId);

        $viewData = [
            'user' => $user,
            'reservations' => $reservations,
            'histories' => $histories,
            'favorites' => $favorites,
            'shops' => $shops,
            'reviews' => $reviews,
        ];

        if ($user->hasRole('admin')) {
            $viewData['roleView'] = 'mypage.admin';
        } elseif ($user->hasRole('shop')) {
            $viewData['roleView'] = 'mypage.shop';
        } else {
            $viewData['roleView'] = 'mypage.user';
        }

        return view('mypage.mypage', $viewData);
    }

    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return back();
    }

    public function edit(Reservation $reservation)
    {
        $user = Auth::user();
        $shop = Shop::find($reservation->shop_id);
        $review = Review::where('user_id', $user->id)->where('shop_id', $shop->id)->first();

        $shopReviews = Review::where('shop_id', $reservation->shop_id)->get();
        $avgRating = round(Review::where('shop_id', $reservation->shop_id)->avg('rating'), 1);
        $countFavorites = Favorite::where('shop_id', $reservation->shop_id)->count();

        $backRoute = '/mypage';

        return view('detail', compact('reservation', 'user', 'shop', 'review', 'shopReviews', 'avgRating', 'countFavorites', 'backRoute'));
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $edit = $request->all();
        Reservation::find($reservation->id)->update($edit);
        return redirect('/done');
    }

    public function favoriteDestroy(Shop $shop)
    {
        Auth::user()->favorites()->where('shop_id',$shop->id)->delete();

        return back();
    }

    public function reservationDestroy(Reservation $reservation)
    {
        $reservation->delete();

        return back();
    }

    private function getReservationsByStatus($status)
    {
        return Auth::user()->reservations()
            ->where('status', $status)
            ->with('shop')
            ->orderBy('date', $status === '予約' ? 'asc' : 'desc')
            ->orderBy('time', $status === '予約' ? 'asc' : 'desc')
            ->get();
    }

    public function pay(Request $request){

        Stripe::setApiKey(config('services.stripe.secret'));
        $user = Auth::user();

        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        Charge::create([
            'amount' => 100,
            'currency' => 'jpy',
            'source' => $request->stripeToken,
        ]);

        $user->update([
            'stripe_id' => $user->stripe_id,
        ]);

        return back();
    }
}