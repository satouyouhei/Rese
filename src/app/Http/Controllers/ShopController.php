<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ShopController extends Controller
{
    public function getIndex(){

        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = $this->getFavorites();

        return view('index', compact('shops', 'areas', 'genres','favorites'));
        
    }

    public function detail(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop_id = $request->shop_id;
        $shop = Shop::find($shop_id);
        $review = Review::where('user_id', $userId)->where('shop_id', $shop_id)->first();
        $from = $request->input('from');

        $shopReviews = Review::where('shop_id', $shop_id)->get();
        $avgRating = round(Review::where('shop_id', $shop_id)->avg('rating'), 1);
        $countFavorites = Favorite::where('shop_id', $shop_id)->count();
        
        $backRoute = '/';
         switch ($from) {
            case 'index':
                $backRoute = '/';
                break;
            case 'mypage':
                $backRoute = '/mypage';
                break;
            case 'review':
                $backRoute = route('review', $shop_id);
                break;
        }
        return view('detail', compact('user', 'shop', 'review', 'avgRating', 'countFavorites', 'backRoute'));
    }

    public function store(ReservationRequest $request)
    {

        $reservation = new Reservation();
        $reservation->shop_id = $request->shop_id;
        $reservation->user_id = Auth::user()->id;
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->status = "予約";
        $reservation->save();
        

        return redirect('/done');
    }

    public function search(Request $request)
    {
        $shops = $this->searchShops($request);
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = $this->getFavorites();

        return view('index', compact('shops', 'areas', 'genres', 'favorites'));
    }

    private function searchShops(Request $request): \Illuminate\Support\Collection
    {
        $area = $request->input('area');
        $genre = $request->input('genre');
        $word = $request->input('word');

        $query = Shop::with(['area', 'genre'])
            ->when($area, function ($query) use ($area) {
                return $query->where('area_id', $area);
            })
            ->when($genre, function ($query) use ($genre) {
                return $query->where('genre_id', $genre);
            })
            ->when($word, function ($query) use ($word) {
                return $query->where('name', 'like', '%' . $word . '%');
            });

        return $query->get();
    }
    
    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }

}
