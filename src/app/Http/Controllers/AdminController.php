<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use League\Csv\Statement;

class AdminController extends Controller
{

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('shop');

        return view('admin.done');
    }

    public function csvImport(Request $request){
        $csvFile = $request->file('file');
        $csv = Reader::createFromPath($csvFile->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        $errors = [];
        $rowNumber = 2;
        
        foreach($records as $record){
            $shopMsgs = [
                '店舗名.required' => '店舗名は50文字以内で入力してください',
                '地域.required' => '地域は「東京都」「大阪府」「福岡県」のいずれかを入力してください',
                '地域.exists' => '地域は「東京都」「大阪府」「福岡県」のいずれかを入力してください',
                'ジャンル.required' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを入力してください',
                'ジャンル.exists' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを入力してください',
                '店舗概要.required' => '店舗概要は400文字以内で入力してください',
                '画像URL.url' => '画像URLは、URL形式で「jpeg」「png」のみアップロード可能です',
                '画像URL.regex' => '画像URLは、URL形式で「jpeg」「png」のみアップロード可能です'
            ];
            
            $validator = Validator::make($record,[
                '店舗名' => 'required|max:50',
                '地域' => 'required|exists:areas,name',
                'ジャンル' => 'required|exists:genres,name',
                '店舗概要' => 'required|max:400',
                '画像URL' => ['required','url','regex:/\.(jpeg|png)$/i'],
            ],$shopMsgs);

            if ($validator->fails()) {
                foreach ($validator->errors()->messages() as $field => $message) {
                    foreach ($message as $specificError) {
                        $errors[] = "行{$rowNumber}: {$specificError}";
                    }
                }
                $rowNumber++;
                continue;
            }

            $area =  Area::where('name', $record['地域'])->first();
            $genre =  Genre::where('name', $record['ジャンル'])->first();
            
            Shop::create([
                'name' => $record['店舗名'],
                'area_id' => $area->id,
                'genre_id' => $genre->id,
                'outline' => $record['店舗概要'],
                'image_url' => $record['画像URL']
            ]);
            
            $rowNumber++;
       }

        if (!empty($errors)) {
            return back()->with('errors', $errors);
        }

       return back()->with('success','CSVファイルのインポート完了しました');
    }
}