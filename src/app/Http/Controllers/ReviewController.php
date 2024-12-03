<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index(Request $request , $shop_id)
    {
        $userId = Auth::id();

        $review = Review::where('user_id', $userId)->where('shop_id', $shop_id)->first();
        $shop = Shop::where('id', $shop_id)->first();
        $favorites = Auth::user()->favorites()->pluck('shop_id')->toArray();
        $from = $request->input('from');

        $backRoute = '/';
        switch ($from) {
            case 'detail':
                $backRoute = route('shopDetail',$shop_id);
                break;
            case 'mypage':
                $backRoute = '/mypage';
                break;
        }

        return view('reviews.index', compact('review', 'shop', 'favorites','backRoute'));
    }

    public function store(ReviewRequest $request, $shop_id)
    {
        $userId = Auth::id();
        $review = Review::where('user_id', $userId)->where('shop_id', $shop_id)->first();

        if ($review) {
            $form = $request->all();
            unset($form['_token']);
            if($request->hasFile('image_url')){
                $image = $request->file('image_url');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('',$filename,'public');
                $review['image_url'] = Storage::disk('public')->url($path);
            }

            Review::find($review->id)->update($form);
        } else {
            $review = new Review();
            $review->user_id = $userId;
            $review->shop_id = $shop_id;
            $review->rating  = $request->input('rating');
            $review->comment = $request->input('comment');
            if($request->hasFile('image_url')){
                $image = $request->file('image_url');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public',$filename,'public');
                $review['image_url'] = Storage::disk('public')->url($path);
            }
            $review->save();
        }

        return view('reviews.thanks', compact('shop_id'));
    }

    public function delete($review_id)
    {
        Review::find($review_id)->delete();
        return redirect()->back()->with('success','口コミを削除しました');
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $shop_id =$request->shop_id;
        $shop = shop::find($shop_id);
        $shopReviews = Review::where('shop_id', $shop_id)->get();
        $avgRating = round(Review::where('shop_id', $shop_id)->avg('rating'), 1);
        $countFavorites = Favorite::where('shop_id', $shop_id)->count();

        $backRoute = route('shopDetail',$shop_id);

        return view('reviews.list', compact('user','shop', 'shopReviews', 'avgRating','backRoute'));
    }

    public function confirm($reservationId)
    {
        $reservation = Reservation::find($reservationId);
        $reservation->status = '来店';
        $reservation->save();

        return redirect('/scan');
    }
}