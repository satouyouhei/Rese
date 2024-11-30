<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop_Representatives;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManagementScreenController extends Controller
{
   public function editIndex()
    {
        $areas = Area::all();
        $genres = Genre::all();

        $shopRepresentative = Auth::user()->shopRepresentative;
        $shop = null;

        if ($shopRepresentative) {
            $shop = $shopRepresentative->shop;
        }

        return view('shop.shop_edit', compact('areas', 'genres', 'shop'));
    }

    public function create_and_edit(Request $request)
    {
        $shopRepresentative = Auth::user()->shopRepresentative;

        if ($shopRepresentative) {
            $shop = $request->except(['_token', 'image_url']);

            if ($request->image_url) {
                $image = $request->image_url;
                $path = $image->store('public');
                $shop['image_url'] = basename(Storage::disk('public')->url($path));
            }

            Shop::find($shopRepresentative->shop_id)->update($shop);
            return back()->with('success', '店舗情報を更新しました。');

        } else {
            $shop = $request->except(['image_url']);
            $image = $request->image_url;
            $path = $image->store('public');
            $shop['image_url'] = basename(Storage::disk('public')->url($path));

            $createdShop = Shop::create($shop);

            $shopRepresentative = new Shop_Representatives();
            $shopRepresentative->user_id = Auth::user()->id;
            $shopRepresentative->shop_id = $createdShop->id;

            $shopRepresentative->save();

            return back()->with('success', '店舗情報を作成しました。');
        }
    }

    public function reservationIndex(Request $request)
    {
        Carbon::setLocale('ja');

        if ($request->has('prevDate')) {
            $displayDate = Carbon::parse($request->input('displayDate'))->subDay();
        } elseif ($request->has('nextDate')) {
            $displayDate = Carbon::parse($request->input('displayDate'))->addDay();
        } else {
            $displayDate = Carbon::now();
        }

        $shopRepresentative = Auth::user()->shopRepresentative;
        $reservations = null;

        if ($shopRepresentative) {
            $reservations = Reservation::with('user')
                ->where('shop_id', $shopRepresentative->shop_id)
                ->whereDate('date', $displayDate)
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();
        }

        return view('shop.shop_reservation', compact('displayDate', 'reservations'));
    }

    public function update(Request $request)
    {
        $reservation = $request->all();
        $reservation['number'] = str_replace('人', '', $reservation['number']);
        unset($reservation['_token']);
        Reservation::find($request->id)->update($reservation);

        return back()->with('update', '予約情報を更新しました');
    }

    public function destroy(Request $request)
    {
        Reservation::find($request->id)->delete();

        return back()->with('delete', '予約情報を削除しました');
    }
}
