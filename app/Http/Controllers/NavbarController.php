<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Singer;
use App\Models\User;


class NavbarController extends Controller
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function navbarAdmin()
    {

        $message = User::join('user_messages', 'user_messages.user_id', "=", "users.id")
        ->join('messages', 'messages.id', "=", "user_messages.message_id")->get();
        // dd($message);
        $admin = request()->user();

        $singers = Singer::all();

        $categorys = Category::all();

        $unreadMessages= Message::where('status', 0)->get();

        $usersAll = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
            ->join('infors', 'infors.id', "=", "infor_users.infor_id")->join('role_users', 'role_users.user_id', "=", "users.id")->get();

        $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
            ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
        if (isset($admin)) {
            if (isset($profileAdmin->avatar)) {
                return  view($this->name, ['profileAdmin' => $profileAdmin, 'usersAll' => $usersAll, 'singers' => $singers,'categorys'=>$categorys ,'unreadMessages' => $unreadMessages,'message'=>$message]);
            } else {
                return view($this->name, ['admin' => $admin, 'usersAll' => $usersAll]);
            }
        }
        return view($this->name);
    }
    public function navbarUser()
    {
        $users = request()->user();
        if (isset($users)) {
            $profile = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
            ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $users->id)->first();
            $role = User::join('role_users', 'role_users.user_id', "=", "users.id")->where('user_id', $users->id)->first();
            $profile = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
                ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $users->id)->first();
            if (isset($profile->avatar)) {
                return view($this->name, ['profile' => $profile, 'role' => $role]);
            } else {
                return view($this->name, ['users' => $users, 'role' => $role]);
            }
        }
        return view($this->name);
    }
}
