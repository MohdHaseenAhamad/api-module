<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\UserController;
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
Route::group(['middleware'=>'api'],function($routes){
    Route::post('user/register',[UserController::class,'register']);
    Route::post('user/login',[UserController::class,'login']);
    Route::post('user/profile',[UserController::class,'profile']);
});


Route::post('student/store',[StudentController::class,'store']);
Route::get('student',[StudentController::class,'index']);
Route::get('student/show/{id}',[StudentController::class,'show']);
Route::put('student/update/{id}',[StudentController::class,'update']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
