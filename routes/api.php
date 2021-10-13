<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users',App\Http\Controllers\Api\UserController::class)
    ->only('index','show','store','update','destroy');

//Route::get('/users',function (){
//    abort(500,'Bir hata oluştu');
//    return \App\Models\User::all();
//    return response()->json(['users'=>\App\Models\User::all(),200]);
//    UserResource::withoutWrapping();
//    return UserResource::collection(User::all());
//    return User::where("id",1)->get();
//});
