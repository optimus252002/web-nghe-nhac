<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Admin\DashboardControler;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function create()
    {
        return view('auth.admin.loginAdmin');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'error' => 'The email or password is incorrect, please try again'
            ]);
        }
        $admin = request()->user();
        if($admin->role == 1||$admin->role == 2) {
            # code...
            $profileAdmin = User::join('infor_users', 'infor_users.user_id', "=", "users.id")
                ->join('infors', 'infors.id', "=", "infor_users.infor_id")->where('user_id', $admin->id)->first();
            if (isset($profileAdmin->avatar)) {
                $extendFilterData = new DashboardControler();
                return $extendFilterData->view();
            } else {
                $extendFilterData = new DashboardControler();
                return $extendFilterData->view();
            }
        }else{
            return redirect()->route('error');

        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('admin.view.login');
    }
}
