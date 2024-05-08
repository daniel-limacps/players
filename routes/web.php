<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function(){
    return view('index');
});

Route::get('/player', [PlayerController::class, 'listplayers']);

Route::get('/player/addplayer', [PlayerController::class, 'addplayer']);

Route::post('/player/store', [PlayerController::class, 'store']);

Route::get('/absent/{id}/{value}', [PlayerController::class, 'absent']);

Route::get('/remove/{id}', [PlayerController::class, 'remove']);

Route::get('/updateplayer/{id}', [PlayerController::class, 'updateplayer']);

Route::put('/update/{id}', [PlayerController::class, 'update']);

Route::get('/teams', [PlayerController::class, 'teams']);

Route::post('/createteams', [PlayerController::class, 'createteambyplayers']);
