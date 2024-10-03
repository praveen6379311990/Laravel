<?php

use App\Http\Controllers\authendication;
use App\Http\Controllers\index;
use App\Http\Controllers\user;
use Illuminate\Support\Facades\Route;

Route::get('/', [index::class,'home']);

Route::get('/login', [authendication::class,'viewLoginPage']);
Route::post('/checkLogin', [authendication::class,'checkLogin']);

Route::get('/user',[user::class,'viewUser']);
