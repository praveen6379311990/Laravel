<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class authendication extends Controller
{
    public function viewLoginPage(){
        return view('Authendication.login');
    }

    public function checkLogin(Request $request){
        $role = $request->input('role');
        if($role === 'admin'){
            $username = 'Admin';
            $request->session()->put('username', $username);
          return redirect('/');
        }elseif($role === 'user'){
            $username = 'User';
            $request->session()->put('username', $username);
            return redirect('/');
        }
    }
}
