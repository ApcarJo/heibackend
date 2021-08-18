<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PassportAuthController;

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

// Route::get('allusers', [UserController::class, 'index']);
// Route::post('finduser', [UserController::class, 'byName']);


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

    // return $request->user();
});
