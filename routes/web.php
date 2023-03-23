<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\JsonController;

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


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('petugas', PetugasController::class);
Route::resource('desa', DesaController::class);
Route::resource('penjadwalan', PenjadwalanController::class);

Route::get('getUserByIdDesa/{id}', [JsonController::class, 'getUserByIdDesa'])->name('getUserByIdDesa');
Route::get('getJadwalByDesa', [JsonController::class, 'getJadwalByDesa'])->name('getJadwalByDesa');

