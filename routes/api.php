<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\account;
use App\Http\Controllers\api\project;

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

Route::post("/login", [account::class,"login"]);

Route::group(["middleware" => ["auth:api"]], function () {

    Route::post("/logout", [account::class, "logout"]);
    Route::get("/profile",[account::class,"profile"]);
    Route::post("/createuser",[account::class,"store"])->middleware("can:user");
    Route::post("/updateuser", [account::class,"update"])->middleware("can:user");
    Route::post("/deleteuser", [account::class,"delete"])->middleware("can:user");
    Route::get("/getalluser", [account::class,"getalluser"])->middleware("can:user");
    
    Route::post("/createimage", [project::class,"createimage"])->middleware("can:project");
    Route::post("/createproject",[project::class,"createproject"])->middleware("can:project");
    Route::post("/updateproject",[project::class,"updateproject"])->middleware("can:project");
    Route::post("/deleteproject",[project::class,"deleteproject"])->middleware("can:project");

});

Route::get("/getallproject",[project::class,"getallproject"]);

