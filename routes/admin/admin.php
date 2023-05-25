<?php

use App\Http\Controllers\Admin\AccountManagementController;
use App\Http\Controllers\Admin\DashboardControler;
use App\Http\Controllers\Admin\FilterDataController;
use App\Http\Controllers\Admin\SingerController;
use App\Http\Controllers\Admin\SingerSongController;
use App\Http\Controllers\Admin\SongController as AdminSongController;
use App\Http\Controllers\NavbarController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('admin')->group(function () {
    // trả về view lỗi
    Route::get('error', function () {
        return view('admin.error');
    })->name('error');
// view trang chủ Admin
    Route::get('index', function () {
        $name = "admin.layout";
        $extendNavbar = new NavbarController($name);
        return $extendNavbar->navbarAdmin();
    })->name('admin.layout')->middleware('checklogin::class');
// view quản lý account
    Route::controller(AccountManagementController::class)->group(function () {
        Route::get('accountmanagement', 'accountManage')->name('admin.account.management');
    });
// view trang dashboard
    Route::controller(DashboardControler::class)->group(function () {
        Route::get('dashboard', 'view')->name('admin.dashboard');
    });
// view trang quản lý bài hát
    Route::controller(AdminSongController::class)->group(function () {
        Route::get('createsong', 'view')->name('admin.create.song');
        Route::get('checkSong', 'checkUpload')->name('admin.check.upload');
        Route::post('checkSong', 'checkUpload')->name('admin.filterdata');
        Route::get('listSong', 'listSong')->name('admin.list.song');
        Route::post('listSong', 'listSong')->name('admin.listsong.filterdata');
        Route::get('editSong', 'editSong')->name('admin.search.song');
        Route::post('editSong', 'editSong')->name('admin.filterdatas');
        Route::get('editSong/{id}', 'filterSong')->name('admin.edit.song');
        Route::post('editSong/{song_id}', 'doEdit')->name('admin.doEdit.song');
        Route::get('deletesong/{id}', 'deleteSong')->name('admin.delete.song');
        Route::post('actionSubmit{id}', 'actionSubmit')->name('admin.song.action.submit');
        Route::get('actionDelete/{id}', 'actionDelete')->name('admin.song.action.delete');
        Route::post('sessionSong', 'sessionSong')->name('admin.session.song');
    });
// view trang quản lý ca sĩ
    Route::controller(SingerController::class)->group(function () {
        Route::get('createSinger', 'createSinger')->name('admin.create.singer');
        Route::post('createSinger', 'doCreate')->name('admin.doCreate.singer');
        Route::get('singersong', 'singerSong')->name('admin.singerSong');
        Route::get('listsong={singer_id}', 'listSingerSong')->name('admin.list.singerSong');
        Route::post('findsinger', 'findSinger')->name('admin.find.singer');
        Route::get('editsinger', 'listSinger')->name('admin.list.singer');
        Route::get('editsinger={singer_id}', 'editSinger')->name('admin.edit.singer');
        Route::post('editsinger={singer_id}', 'doEditSinger')->name('admin.doEdit.singer');
    });
// view trang quản lý bài hát của ca sĩ
    Route::controller(SingerSongController::class)->group(function () {
        Route::get('createDBSingersong', 'listCreateDB')->name('admin.createDB.singer.song');
        Route::get('search', 'searchSingerSong')->name('admin.search');
        Route::get('Edit-singer_song/{song_id}/{singer_id}', 'editSingerSong')->name('admin.edit.singer.song');
        Route::post('doEdit/{song_id}{singer_id}', 'doEdit')->name('admin.doEdit');
    });
});
