<?php

namespace App\Http\Controllers;

use App\Models\Adduser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class user extends Controller
{
    public function viewUser(){
        $username = Session::get('username', ' ');
        $role = Session::get('role', '');
        $allUser = Adduser::all();

        return view('User.user',['username'=>$username,'role'=>$role, 'listUser'=>$allUser]);
    }

    public function addUsers(Request $request){
        // dd($request);
        $addUser = new Adduser();
        $password = Hash::make($request->password);

        $addUser->name = $request->username;
        $addUser->email_id = $request->email;
        $addUser->password = $password;
        $addUser->save();
        return back()->withSuccess('User Added Successfully');
    }

    public function editUsers($id){
        $username = Session::get('username', ' ');
        $role = Session::get('role', '');

        $getUserData = DB::table('addusers')->where('id', $id)->get();

        return view('User.editUser',['username'=>$username,'role'=>$role,'getUserData'=>$getUserData]);
    }

    public function updateUsers(Request $request, $id){
        // dd($request);
        $updateUser = Adduser::where('id', $id)->first();
        $updateUser->name = $request->username;
        $updateUser->email_id = $request->email;
        $updateUser->password = Hash::make( $request->password);
        $updateUser->save();

        return redirect('/user')->withSuccess('User updated Successfully');
    }

    public function deleteUsers($id){
        DB::table('addusers')->where('id', $id)->delete();
        DB::table('user_tasks')->where('user_id', $id)->delete();
        return back()->with('message', 'Task deleted Successfully');
    }

}
