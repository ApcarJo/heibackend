<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\VanController;
use App\Http\Controllers\VanGWController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserTeamController;
use App\Http\Controllers\GwscheduleController;
use App\Http\Controllers\GwupdateController;
use App\Http\Controllers\MatchgwController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\UsergwController;

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

Route::middleware('auth:api')->group(function () {


    //USER CONTROLLER
    Route::get('allusers', [UserController::class, 'index']);
    Route::post('finduser', [UserController::class, 'byName']);
    Route::post('selectuser', [UserController::class, 'userSelector']);
    Route::post('chooseuser', [UserController::class, 'byId']);
    Route::get('activeusers', [UserController::class, 'showActive']);
    Route::get('findarchiveuser', [UserController::class, 'showarchive']);
    Route::put('archiveuser', [UserController::class, 'archive']);
    Route::delete('deleteuser', [UserController::class, 'destroy']);
    Route::put('modifyuser', [UserController::class, 'update']);
    Route::post('userrole', [UserController::class, 'userrole']);


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

    //GWUPDATE CONTROLLER
    Route::get('allgwupdates', [GwupdateController::class, 'index']);
    Route::post('findgwupdate', [GwupdateController::class, 'byName']);
    Route::post('choosegwupdate', [GwupdateController::class, 'byId']);
    Route::get('activegwupdate', [GwupdateController::class, 'showActive']);
    Route::get('showarchived', [GwupdateController::class, 'showArchive']);
    Route::delete('deletegwupdate', [GwupdateController::class, 'destroy']);
    Route::put('modifygwupdate', [GwupdateController::class, 'update']);
    Route::post('creategwupdate', [GwupdateController::class, 'create']);
    Route::post('gwupdateselector', [GwupdateController::class, 'selector']);
    Route::put('archivegwupdate', [GwupdateController::class, 'archive']);

    //USERTEAM CONTROLLER
    Route::get('alluserteam', [UserTeamController::class, 'index']);
    Route::post('bygwschedule', [userTeamController::class, 'byGWSchedule']);
    Route::post('chooseuserteam', [userTeamController::class, 'byId']);
    Route::get('activeuserteam', [userTeamController::class, 'showActive']);
    Route::delete('deleteuserteam', [userTeamController::class, 'destroy']);
    Route::put('modifyuserteam', [userTeamController::class, 'update']);
    Route::post('createuserteam', [userTeamController::class, 'create']);


    //GW SCHEDULE CONTROLLER
    Route::get('allgwschedules', [GwscheduleController::class, 'index']);
    Route::post('creategwschedule', [GwscheduleController::class, 'create']);
    Route::post('choosegwschedule', [GwscheduleController::class, 'byId']);
    Route::post('gwscheduleselector', [GwscheduleController::class, 'selector']);
    Route::get('activegwschedule', [GwscheduleController::class, 'showActive']);
    Route::post('findgwschedule', [GwscheduleController::class, 'byName']);
    Route::post('findbydateschedule', [GwscheduleController::class, 'byDate']);
    Route::put('modifygwschedule', [GwscheduleController::class, 'update']);
    Route::delete('deletegwschedule', [GwscheduleController::class, 'destroy']);
    Route::post('archivegwschedule', [GwscheduleController::class, 'archive']);

    //ASSET CONTROLLER
    Route::get('allassets', [AssetController::class, 'index']);
    Route::post('createasset', [AssetController::class, 'create']);
    Route::post('chooseasset', [AssetController::class, 'byId']);
    Route::post('byKitVan', [AssetController::class, 'bykitVan']);
    Route::post('findasset', [AssetController::class, 'byName']);
    Route::post('bymodel', [AssetController::class, 'byModel']);
    Route::post('byWarrantyYear', [AssetController::class, 'byWarrantyYear']);
    Route::put('modifyasset', [AssetController::class, 'update']);
    Route::delete('deleteasset', [AssetController::class, 'destroy']);

    //MATCH GW CONTROLLER
    Route::get('allmatchgws', [MatchgwController::class, 'index']);
    Route::post('creatematchgw', [MatchgwController::class, 'create']);
    Route::post('choosematchgw', [MatchgwController::class, 'byId']);
    Route::post('bygwschedule', [MatchgwController::class, 'byGwschedule']);
    Route::get('activematchgw', [MatchgwController::class, 'showActive']);
    Route::post('byteamid', [MatchgwController::class, 'byName']);
    Route::put('modifymatchgw', [MatchgwController::class, 'update']);
    Route::delete('deletematchgw', [MatchgwController::class, 'destroy']);

    //USER GW CONTROLLER
    Route::get('allusergws', [UsergwController::class, 'index']);
    Route::post('createusergw', [UsergwController::class, 'create']);
    Route::post('chooseusergw', [UsergwController::class, 'byId']);
    Route::post('byuserteam', [UsergwController::class, 'byUserTeam']);
    Route::get('activeuser', [UsergwController::class, 'showActive']);
    Route::post('byuserid', [UsergwController::class, 'byuserId']);
    Route::post('byallgw', [UsergwController::class, 'byAllGW']);
    Route::post('bygw', [UsergwController::class, 'byGW']);
    Route::put('modifyusergw', [UsergwController::class, 'update']);
    Route::delete('deleteusergw', [UsergwController::class, 'destroy']);

});
