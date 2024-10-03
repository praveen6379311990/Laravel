<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class user extends Controller
{
    public function viewUser(){
        $username = Session::get('username', ' ');
        return view('User.user',['username'=>$username]);
    }
}
