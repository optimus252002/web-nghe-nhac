<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
        $users = request()->user();
        # code...
         
        $profile = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
            ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $users->id)->first();
        
            # code...
          
        if (isset($profile->avatar)) {
            return view('client.index', ['profile' => $profile]);
        } else {
            return view('client.index', ['users' => $users]);
    }
    }
    public function destroy()
    {
        Auth::logout();

        return redirect()->route('client.index');
    }
}
