<?php

namespace App\Http\Controllers;

use App\Models\addTasks;
use App\Models\Adduser;
use App\Models\user_task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class task extends Controller
{
    public function viewTask()
    {
        $username = Session::get('username', ' ');
        $allUser = Adduser::all();
        $addTasks = addTasks::all();

        $availableUser = [];
        $availableTask = [];
        foreach ($allUser as $user) {
            $availableUser[] = $user['name'];
        }
        $role = Session::get('role', '');

        if ($role == 'admin') {
            return view('Task.task', ['username' => $username, 'availableUser' => $availableUser, 'role' => $role, 'allTasks' => $addTasks]);
        } else if ($role == 'user') {
            $userTasks =  Adduser::select('id')->where('name', '=', $username)->get();
            $userIds = [];
            foreach ($userTasks as $userId) {
                $userIds[] = $userId['id'];
            }
            $user = AddUser::find($userId['id']);
            $tasks = $user->tasks;
            // print_r($tasks);
            return view('Task.task', ['username' => $username, 'availableUser' => $availableUser, 'role' => $role, 'tasks' => $tasks]);
        }
    }

    public function addTasks(Request $request)
    {
        // dd($request);
        $addTasks = new addTasks();
        $usertask = new user_task();

        $addTasks->taskname = $request->taskname;
        $addTasks->description = $request->description;
        $addTasks->date = $request->date;
        $addTasks->priority = $request->priority;
        $addTasks->assignTask = $request->assignTask;
        $addTasks->processOfWork = $request->processOfWork;
        $addTasks->save();

        $userIds = Adduser::where('name', '=', $request->assignTask)->get();

        $getUserId = '';
        foreach ($userIds as $userId) {
            $getUserId = $userId['id'];
        }
        $usertask->user_id = $getUserId;
        $usertask->task_id =  $addTasks->id;
        $usertask->save();

        return back()->withSuccess('User Added Successfully');
    }

    public function updateTask($id)
    {
        $username = Session::get('username', ' ');
        $allUser = Adduser::all();

        $availableUser = [];
        foreach ($allUser as $user) {
            $availableUser[] = $user['name'];
        }


        $role = Session::get('role', '');
        $idTasks = DB::table('add_tasks')->where('id', $id)->get();
        return view('Task.updateTask', ['username' => $username, 'role' => $role, 'idTasks' => $idTasks, 'availableUser' => $availableUser]);
    }

    public function updateTaskData(Request $request, $id)
    {
        $usertask = new user_task();
        $addTasks = addTasks::where('id', $id)->first();
        $addTasks->taskname = $request->taskname;
        $addTasks->description = $request->description;
        $addTasks->date = $request->date;
        $addTasks->priority = $request->priority;
        $addTasks->assignTask = $request->assignTask;
        $addTasks->processOfWork = $request->processOfWork;
        $addTasks->save();
        $userIds = Adduser::where('name', '=', $request->assignTask)->get();
        $getUserId = '';
        foreach ($userIds as $userId) {
            $getUserId = $userId['id'];
        }
        $usertask = user_task::where('task_id', $id)->first();
        $usertask->user_id = $getUserId;
        $usertask->task_id =  $addTasks->id;
        $usertask->save();

        return redirect('/task')->withSuccess('User updated Successfully');
    }

    public function deleteTask($id)
    {
        DB::table('add_tasks')->where('id', $id)->delete();
        DB::table('user_tasks')->where('task_id', $id)->delete();
        return back()->with('message', 'Task deleted Successfully');
    }
    public function updateUserTask($id)
    {
        $username = Session::get('username', ' ');
        $allUser = Adduser::all();

        $availableUser = [];
        foreach ($allUser as $user) {
            $availableUser[] = $user['name'];
        }


        $role = Session::get('role', '');
        $idTasks = DB::table('add_tasks')->where('id', $id)->get();
        return view('Task.userUpdate', ['username' => $username, 'role' => $role, 'idTasks' => $idTasks, 'availableUser' => $availableUser]);
    }

    public function updateUserStatus(Request $request, $id)
    {
        $addTasks = addTasks::where('id', $id)->first();
        $addTasks->processOfWork = $request->processOfWork;
        $addTasks->save();
        return redirect('/task')->withSuccess('User updated Successfully');
    }
}
