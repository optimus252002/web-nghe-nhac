<?php

namespace App\Http\Controllers\Admin;

use App\Models\Singer;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;

class SingerController extends Controller
{
    public function createSinger()
    {
        $unreadMessages= Message::where('status', 0)->get();
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
        ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        return view('admin.singer.createSinger',compact('profileAdmin','unreadMessages'));
    }
    public function doCreate()
    {
        # create singer in db 
        {
            $validated = request()->validate([
                'nameSinger' => 'required',
                'imageSinger' => 'required',
            ]);
            $nameSinger = request()->nameSinger;
            $imageSinger =  request()->imageSinger;
            $checkSinger = Singer::where('name_singer', $nameSinger)->first();
            // dd($checkSinger);
            if ($checkSinger !=  null) {
                echo ('da co ca si');
            } else {
                $imageSinger = request()->file('imageSinger');
                $fileImage = time() . '.' . $imageSinger->getClientOriginalName();
                $imageSinger->storeAs('image_singer', $fileImage, 'public');
                $imageSinger = 'storage/image_singer/' . $fileImage;
                Singer::create([
                    'name_singer' =>  $nameSinger,
                    'image_singer' => $imageSinger,
                ]);
                return redirect()->back();
            }
        }
    }
    public function singerSong()
    {
        $unreadMessages= Message::where('status', 0)->get();
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
        ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        $singers = Singer::all();
        $sum = $singers ->count();
        return view('admin.singer.singerSong', compact('singers', 'sum','profileAdmin','unreadMessages'));
    }
    public function listSingerSong($singer_id)
    {
        $unreadMessages= Message::where('status', 0)->get();
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
        ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        $singerSongs = Category::join('category_songs', 'categories.id', "=", "category_songs.category_id")
        ->join('songs', 'category_songs.song_id', "=", "songs.id")
        ->join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
        ->join('singers', 'singer_songs.singer_id', "=", "singers.id")
        ->where('singer_id',$singer_id)
        ->get();
        $sum = $singerSongs->count();
      return view('admin.singer.singerSong',compact('singerSongs','sum','profileAdmin','unreadMessages'));
    }
    public function findSinger()
    {
        $unreadMessages= Message::where('status', 0)->get();
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
        ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
       $nameSinger = request()->singerSong;
       $singers = Singer::where('name_singer', 'LIKE', '%' . $nameSinger . '%')->get();
        $sum = $singers->count();
      return view('admin.singer.singerSong',compact('singers','sum','profileAdmin','unreadMessages'));
    }
    public function listSinger()
    {
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
        ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        $singers = Singer::all();
        $sum = $singers ->count();
        return view('admin.singer.editSinger', compact('singers', 'sum','profileAdmin'));
    }
    public function editSinger($singer_id)
    {
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
        ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        $singerSongs = Singer::where('id',$singer_id)->first();
        return view('admin.singer.doEditsinger', compact('singerSongs','profileAdmin'));
    }
    public function doEditSinger($singer_id)
    {
        $nameSinger = request()->nameSinger;
        $imageSinger = request()->file('imageSinger');
        $fileImage = time() . '.' . $imageSinger->getClientOriginalName();
        $imageSinger->storeAs('image_singer', $fileImage, 'public');
        $imageSinger = 'storage/image_singer/' . $fileImage;
        $updateSinger = Singer::find($singer_id);
        $updateSinger->update([
            'name_singer' => $nameSinger,
            'image_singer' => $imageSinger,
        ]);
       
        return view('admin.singer.editSinger');
    }
}
