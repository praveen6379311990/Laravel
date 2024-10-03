<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class index extends Controller
{
    public function home(){
        $username = Session::get('username', ' ');
        return view('Index.index',['username' => $username]);
    }
}
