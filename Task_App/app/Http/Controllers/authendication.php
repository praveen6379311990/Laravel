<?php

namespace App\Http\Controllers;

use App\Models\Adduser;
use App\Models\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class authendication extends Controller
{

    public function register(){
        return view('Authendication.register');
    }

    public function submitRegister(Request $request){
        $addAdmin = new register();
        $password = Hash::make($request->password);

        $addAdmin->name = $request->username;
        $addAdmin->email_id = $request->email;
        $addAdmin->password = $password;
        $addAdmin->save();
        return back()->with('msg', 'Added Successfully');
    }

    public function viewLoginPage(Request $request)
    {
        if ($request->session()->has('username')) {
            return redirect('/');
        }
        return view('Authendication.login');
    }

    public function checkLogin(Request $request)
    {
        $email = $request->email;
        $pwd = $request->password;
        $role = $request->role;
        $username = '';

        if ($role === 'admin') {
            $user = register::where('email_id', '=', $email)->first();
            if ($user && Hash::check($pwd, $user->password)) {
                $request->session()->put('username', $user->name);
                $request->session()->put('role', $role);
               return redirect('/');
            } else {
                return Redirect::back()->with('msg', 'Admin credential is Wrong');
            }
            $username = 'Admin';
            $request->session()->put('username', $username);
            $request->session()->put('role', $role);
            return redirect('/');

        } elseif ($role === 'user') {
            $user = Adduser::where('email_id', '=', $email)->first();

            if (!$user) {
                return redirect('/login');
            }

            if ($user && Hash::check($pwd, $user->password)) {
                $request->session()->put('username', $user->name);
                $request->session()->put('role', $role);
               return redirect('/');
            } else {
                return Redirect::back()->with('msg', 'User credential is Wrong');
            }
        }
    }

}
