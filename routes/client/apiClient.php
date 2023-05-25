<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/song', function () {
    try {
        $categorySongnew = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")->where("category_id",1)
        ->get();
        $categorySonghot = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")->where("category_id",2)
        ->get();
        $array = array( "categorySongnew" =>$categorySongnew, "categorySonghot"=>$categorySonghot);
        return response()->json($array);
    } catch (Exception $e) {
        return response()->json(['status', 500]);
    }
});
// Route::match(array('GET','POST'),'/likesong', function () {
//     try {
//         $nameSong = session()->put('name_song', request()->nameSong);
//         $nameSinger = session()->put('name_singer', request()->nameSinger);
//         $sessionSinger =  session()->get('name_singer');
//         $sessionSong = session()->get('name_song');
//         $array = array("sessionSinger"=>$sessionSinger, "sessionSong"=>$sessionSong);
//         return response()->json($array);
//     } catch (Exception $e) {
//         return response()->json(['status', 500]);
//     }
// });