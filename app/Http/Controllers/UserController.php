<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
