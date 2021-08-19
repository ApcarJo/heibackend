<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\VanController;
use App\Http\Controllers\VanGWController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    
Route::middleware('auth:api')->group(function () {

    //USER CONTROLLER
    Route::get('allusers', [UserController::class, 'index']);
    Route::post('finduser', [UserController::class, 'byName']);
    Route::post('selectuser', [UserController::class, 'userSelector']);
    Route::post('chooseuser', [UserController::class, 'byId']);
    Route::get('activeusers', [UserController::class, 'showActive']);
    Route::put('archiveuser', [UserController::class, 'archive']);
    Route::delete('deleteuser', [UserController::class, 'destroy']);
    Route::put('modifyuser', [UserController::class, 'update']);


    //VAN_GW CONTROLLER
    Route::get('allvangw', [VanGWController::class, 'index']);
    Route::post('choosevangw', [VanGWController::class, 'byId']);
    Route::delete('deletevangw', [VanGWController::class, 'destroy']);
    Route::put('modifyvangw', [VanGWController::class, 'update']);
    Route::post('createvangw', [VanGWController::class, 'create']);

    //VAN CONTROLLER
    Route::get('allvans', [VanController::class, 'index']);
    Route::post('findvan', [VanController::class, 'bycustomName']);
    Route::post('choosevan', [VanController::class, 'byId']);
    Route::get('activevans', [VanController::class, 'showActive']);
    Route::delete('deletevan', [VanController::class, 'destroy']);
    Route::put('modifyvan', [VanController::class, 'update']);
    Route::post('createvan', [VanController::class, 'create']);


    // return $request->user();
});
