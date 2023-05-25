<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class FilterDataController extends Controller
{ 
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
  public function filterData()
  {
      $message = User::join('user_messages', 'user_messages.user_id', "=", "users.id")
      ->join('messages', 'messages.id', "=", "user_messages.message_id")->get();
      $unreadMessages= Message::where('status', 0)->get();
      $date = request()->date;
      $status = request()->status;
      $category = request()->category;
      $searchs = request()->searchs;
      $listSong = Session::all();
      $categorySong = Category::all();
      $admin = request()->user();
      $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
    ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
    if (isset($searchs)) {
        $data = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")
        ->where('name_song', 'LIKE', '%' . $searchs . '%')->get();
        $sum = $data->count();
        return view($this->name, compact('sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    }
    if (isset($status)) {
        $data = Session::where('action','=', $status)->get();
        $sum = $data->count();
        return view($this->name, compact( 'sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    }
    if (isset($category)) {
        $data = Session::where('name_category','=', $category)->get();
        $sum = $data->count();
        return view($this->name, compact( 'sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    }
    if (isset($date)) {
        $data = Session::where('created_at','<=', $date)->get();
        $sum = $data->count();
        return view($this->name, compact( 'sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    };
    if (!isset($date)) {
        $sum = $listSong->count();
        return view($this->name, compact('listSong', 'sum', 'categorySong','profileAdmin','unreadMessages','message'));
    };
  }
  public function filterDatas()
  {
    $message = User::join('user_messages', 'user_messages.user_id', "=", "users.id")
      ->join('messages', 'messages.id', "=", "user_messages.message_id")->get();
    $unreadMessages= Message::where('status', 0)->get();
    $admin = request()->user();
    $date = request()->date;
    $category = request()->category;
    $searchs = request()->searchs;
    $categorySong = Category::all();
    $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
    ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
    if (isset($searchs)) {
        $data = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")
        ->where('name_song', 'LIKE', '%' . $searchs . '%')->get();
        $sum = $data->count();
        return view($this->name, compact('sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    }
    if (isset($category)) {
        $data = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")->where('name_category','=', $category)->get();
        $sum = $data->count();
        return view($this->name, compact( 'sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    }
    if (isset($date)) {
        $data = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")->where('songs.created_at','<=', $date)->get();
        $sum = $data->count();
        return view($this->name, compact( 'sum', 'categorySong','data','profileAdmin','unreadMessages','message'));
    };
    if (!isset($date)||!isset($category)||!isset($searchs)) {
        $listSongs = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")
        ->get();
        $sum = $listSongs->count();
        return  view($this->name, compact('listSongs', 'sum', 'categorySong','profileAdmin','unreadMessages','message'));
    };
  }
}
