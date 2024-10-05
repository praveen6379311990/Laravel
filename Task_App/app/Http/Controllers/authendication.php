<?php

namespace App\Http\Controllers;

use App\Models\Adduser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class authendication extends Controller
{
    public function viewLoginPage(Request $request)
    {
        if ($request->session()->has('username')) {
            return redirect('/');
        }
        return view('Authendication.login');
    }

    public function checkLogin(Request $request)
    {
        // dd($request);
        $email = $request->email;
        $pwd = $request->password; // Keep the plain text password
        $role = $request->role;
        $username = '';

        if ($role === 'admin') {
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
                return Redirect::back()->with('msg', 'The Message');
            }
        }
    }

}
