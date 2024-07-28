<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Forgetcontroller;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');



    Route::post('/login',[Authcontroller::class,'Login']);
    Route::post('/register',[Authcontroller::class,'Register']);
    // forget password route
    Route::post('/forgetPassword',[Forgetcontroller::class,'ForgetPassword']);
    Route::post('/resetpassword',[ResetController::class,'reset']);
    Route::get('/user',[UserController::class,'User'])->middleware('auth:api');


