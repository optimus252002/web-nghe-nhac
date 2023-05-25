<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\Session;
use App\Models\Singer;
use App\Models\Song;
use App\Models\User;

class DashboardControler extends Controller
{

    public function view()
    {
        $message = User::join('user_messages', 'user_messages.user_id', "=", "users.id")
        ->join('messages', 'messages.id', "=", "user_messages.message_id")->get();
        $admin = request()->user();
        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
            ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        $totalSongs = Song::all();
        $totalSingers = Singer::all();
        $totalCategorys = Category::all();
        $unreadMessages = Message::where('status', 0)->get();
        $unapprovedSongs = Session::where('action', 0)->get();
        $dateNow  = date('Y-m-01');
        $lastMonthSong = Song::where('created_at', '<=', $dateNow)->count();
        $currentMonthSong = Song::where('created_at', '>=', $dateNow)->count();
        $lastMonthSinger = Singer::where('created_at', '<=', $dateNow)->count();
        $currentMonthSinger = Singer::where('created_at', '>=', $dateNow)->count();
        $formatSong = ceil((($currentMonthSong - $lastMonthSong) / $lastMonthSong) * 100) . '%';
        $formatSinger = ceil((($currentMonthSinger - $lastMonthSinger) / $lastMonthSinger) * 100) . '%';
        $information = 1;
        if (isset($profileAdmin->avatar)) {
            return view('admin.dashboard', compact(
                'profileAdmin',
                'totalSongs',
                'totalSingers',
                'totalCategorys',
                'unapprovedSongs',
                'unreadMessages',
                'formatSong',
                'formatSinger',
                'message'
            ));
        } else {
            return view('admin.dashboard', compact(
                'admin',
                'totalSongs',
                'totalSingers',
                'totalCategorys',
                'unapprovedSongs',
                'unreadMessages',
                'formatSong',
                'formatSinger',
                'information',
                'message'
            ));
        }
    }
}

// 