<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index()
    {
        $reservations = $this->getReservationsByStatus();

        $favorites = Auth::user()->favorites()
            ->pluck('shop_id')
            ->toArray();

        $shops = Shop::with(['area', 'genre'])
            ->whereIn('id', $favorites)
            ->get();

        $user = Auth::user();
        $viewData = [
            'user' => $user,
            'reservations' => $reservations,
            'favorites' => $favorites,
            'shops' => $shops
        ];

        return view('mypage', $viewData);
    }

    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return back();
    }

    public function favoriteDestroy(Shop $shop)
    {
        Auth::user()->favorites()->where('shop_id',$shop->id)->delete();

        return redirect('/mypage');
    }

    public function reservationDestroy(Reservation $reservation)
    {   
        $reservation->delete();
        return redirect('/mypage');
    }

    private function getReservationsByStatus()
    {
        return Auth::user()->reservations()
            ->with('shop')
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }
}
