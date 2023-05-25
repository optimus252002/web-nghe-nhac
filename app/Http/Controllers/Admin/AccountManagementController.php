<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NavbarController;
use Illuminate\Http\Request;

class AccountManagementController extends Controller
{
    public function accountManage(){
        $name = "admin.accountmanagement";
        $extendNavbar = new NavbarController($name);
        return $extendNavbar->navbarAdmin();
    }
}
