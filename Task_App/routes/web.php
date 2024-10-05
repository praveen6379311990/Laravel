<?php

use App\Http\Controllers\authendication;
use App\Http\Controllers\index;
use App\Http\Controllers\task;
use App\Http\Controllers\user;
use Illuminate\Support\Facades\Route;

Route::get('/', [index::class,'home']);

Route::get('/dashboard', [index::class,'dashboard']);

Route::get('/login', [authendication::class,'viewLoginPage']);
Route::post('/checkLogin', [authendication::class,'checkLogin']);

Route::get('/user',[user::class,'viewUser']);

Route::post('/addusers',[user::class,'addUsers']);

Route::get('/edituser/{id}',[user::class,'editUsers']);

Route::post('/edituserData/{id}',[user::class,'updateUsers']);

Route::get('/deleteUser/{id}',[user::class,'deleteUsers']);

Route::get('/task',[task::class,'viewTask']);

Route::post('/addTasks',[task::class,'addTasks']);

Route::get('/editTask/{id}',[task::class,'updateTask']);

Route::post('/updatedTask/{id}',[task::class,'updateTaskData']);

Route::get('/deleteTask/{id}',[task::class,'deleteTask']);

Route::get('/editTaskUser/{id}',[task::class,'updateUserTask']);

Route::post('/updateduserTask/{id}',[task::class,'updateUserStatus']);

Route::get('/logout',[index::class,'logout']);





