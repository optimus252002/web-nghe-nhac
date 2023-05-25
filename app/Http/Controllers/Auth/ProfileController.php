<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Infor;
use App\Models\InforUser;
use App\Models\Message;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function view(Request $request)
  {

    $users = $request->user();
    $role = User::join('role_users', 'role_users.user_id', "=", "users.id")->where('user_id', $users->id)->first();
    $profile = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
    ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $users->id)->first();
    if (isset($profile->phone)) {
      return view('auth.profile', ['profile' => $profile, 'role' => $role]);
    } else {
      return view('auth.profile', ['users' => $users, 'role' => $role]);
    }
  }
  public function edit($infor_id, $user_id, Request $request)
  {

    $address = request()->address;
    $phone = request()->phone;
    // $email = request()->email;
    //   $updateEmail = User::find($user_id);
    //   $updateEmail->update([
    //     'email' => $email,
    // ]);
    $updateInfor = Infor::find($infor_id);
    $updateInfor->update([
      'address' => $address,
      'phone' => $phone,
    ]);
    $users = $request->user();
    $role = User::join('role_users', 'role_users.user_id', "=", "users.id")->where('user_id', $users->id)->first();
    $profile = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
      ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $users->id)->first();
    return view('auth.profile', ['profile' => $profile, 'role' => $role]);
  }
  public function create($user_id, Request $request)
  {
    $address = request()->address;
    $phone = request()->phone;
    $avatar = request()->file('avatar');
    $fileAvatar = time() . '.' . $avatar->getClientOriginalName();
    $avatar->storeAs('avatar', $fileAvatar, 'public');
    $avatar =  "storage/avatar/" . $fileAvatar;
    $createProfile =  Infor::create([
      'address' => $address,
      'phone' => $phone,
      'avatar' => $avatar,
    ]);
    $infor_id = $createProfile->id;
    $createInfor =  InforUser::create([
      'user_id' => $user_id,
      'infor_id' => $infor_id,
    ]);
    $users = $request->user();
    $role = User::join('role_users', 'role_users.user_id', "=", "users.id")->where('user_id', $users->id)->first();
    $profile = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
      ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $users->id)->first();
    return view('auth.profile', ['profile' => $profile, 'role' => $role]);
  }
  public function message()
  {
    $users = request()->user();
    $user_id = request()->user()->id;
    $postMessage = Message::create([
      'message' => request()->message,
      'status' => 0,
    ]);
    $message_id = $postMessage->id;
    $create_id  = UserMessage::create([
      'user_id'=>$user_id,
      'message_id'=>$message_id,
    ]);
    return view('auth.profile',compact('users'));
  }
}
