<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\API\JadwalMobileController;
use App\Http\Controllers\API\ExceptionMobileController;
use App\Http\Controllers\API\KunjunganMobileController;


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

Route::group(['prefix' => 'v1'], function(){
    Route::post('login', [UsersController::class , 'login']);
    Route::post('register', [UsersController::class , 'register']);
    Route::get('logout', [UsersController::class , 'logout'])->middleware('auth:api');
});
Route::resource('exception_mobile', ExceptionMobileController::class);
Route::resource('jadwal-mobile', JadwalMobileController::class);
Route::resource('kunjungan-mobile', KunjunganMobileController::class);
Route::get('get-desa/{id}', [JadwalMobileController::class, 'show_desa']);

