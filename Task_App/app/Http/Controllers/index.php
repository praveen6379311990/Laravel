<?php

namespace App\Http\Controllers;

use App\Models\addTasks;
use App\Models\Adduser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class index extends Controller
{
    public function home(Request $request)
    {
        if (!$request->session()->has('username')) {
            return redirect('/login');
        }
        $username = Session::get('username', ' ');
        $role = Session::get('role', 'user');
        return view('Index.index', ['username' => $username, 'role' => $role]);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function dashboard()
    {
        $username = Session::get('username', ' ');
        $role = Session::get('role', 'user');
        if($role == 'admin'){
            $allUser = Adduser::all();
            $allTask = addTasks::all();
            return view('Dashboard.dashboard',['username' => $username,'role'=>$role,'allUser'=>$allUser,'allTask'=>$allTask]);

        }else if($role == 'user'){
            $userTasks =  Adduser::select('id')->where('name', '=', $username)->get();
            $userIds = [];
            foreach ($userTasks as $userId) {
                $userIds[] = $userId['id'];
            }
            $user = AddUser::find($userId['id']);
            $tasks = $user->tasks;
            return view('Dashboard.dashboard',['username' => $username,'role'=>$role,'tasks'=>$tasks]);

        }
    }
}
