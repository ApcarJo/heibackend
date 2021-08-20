<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\VanController;
use App\Http\Controllers\VanGWController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\TeamController;

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
    Route::get('allvangw', [VangwController::class, 'index']);
    Route::post('choosevangw', [VangwController::class, 'byId']);
    Route::post('vangwbygwschedule', [VangwController::class, 'findbygwschedule']);
    Route::delete('deletevangw', [VangwController::class, 'destroy']);
    Route::put('modifyvangw', [VangwController::class, 'update']);
    Route::post('createvangw', [VangwController::class, 'create']);
    Route::post('vangwselector', [VangwController::class, 'selector']);
    Route::get('activevangw', [VangwController::class, 'showActive']);

    //VAN CONTROLLER
    Route::get('allvans', [VanController::class, 'index']);
    Route::post('findvan', [VanController::class, 'byName']);
    Route::post('choosevan', [VanController::class, 'byId']);
    Route::get('activevans', [VanController::class, 'showActive']);
    Route::delete('deletevan', [VanController::class, 'destroy']);
    Route::put('modifyvan', [VanController::class, 'update']);
    Route::post('createvan', [VanController::class, 'create']);
    Route::post('vanselector', [VanController::class, 'selector']);

    //STADIUM CONTROLLER
    Route::get('allstadiums', [StadiumController::class, 'index']);
    Route::post('findstadium', [StadiumController::class, 'byName']);
    Route::post('choosestadium', [StadiumController::class, 'byId']);
    Route::get('activestadium', [StadiumController::class, 'showActive']);
    Route::delete('deletestadiums', [StadiumController::class, 'destroy']);
    Route::put('modifystadiums', [StadiumController::class, 'update']);
    Route::post('createstadiums', [StadiumController::class, 'create']);
    Route::post('stadiumselector', [StadiumController::class, 'selector']);

    //TEAM CONTROLLER
    Route::get('allteams', [TeamController::class, 'index']);
    Route::post('findteam', [TeamController::class, 'byName']);
    Route::post('chooseteam', [TeamController::class, 'byId']);
    Route::get('activeteam', [TeamController::class, 'showActive']);
    Route::delete('deleteteam', [TeamController::class, 'destroy']);
    Route::put('modifyteam', [TeamController::class, 'update']);
    Route::post('createteam', [TeamController::class, 'create']);
    Route::post('teamselector', [TeamController::class, 'selector']);


    // return $request->user();
});
