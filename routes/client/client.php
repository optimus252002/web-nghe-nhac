<?php

use App\Http\Controllers\NavbarController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// Route::prefix('client')->group(function () {
Route::get('index', function () {
    $name = "client.index";
    $extendNavbar = new NavbarController($name);
    return $extendNavbar->navbarUser();
})->name('client.index');
Route::get('add-playlist', function () {
    $name = "client.playlist";
    $extendNavbar = new NavbarController($name);
    return $extendNavbar->navbarUser();
})->name('client.addPlaylist');
Route::get('search-song', function () {
    $name = "client.search";
    $extendNavbar = new NavbarController($name);
    return $extendNavbar->navbarUser();
})->name('client.searchSong');

Route::get('playlist/{id}', function ($category_id) {
    // dd($category_id);
    // $extendNavbar = new NavbarController($name);
    $checkPlaylist =  Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
    ->join('songs', 'category_songs.song_id', "=", "songs.id")
    ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
    ->join('singers', 'singer_songs.singer_id', "=", "singers.id")->where("category_id",$category_id)->get();

    return view('client.playlist',compact('checkPlaylist'));
});
Route::get('likesong', function () {
    $name = "client.likesong";
    $extendNavbar = new NavbarController($name);
    return $extendNavbar->navbarUser();
})->name('client.likesong');