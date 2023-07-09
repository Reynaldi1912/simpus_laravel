<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\ExceptionController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\KunjunganController;

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
Route::resource('exception', ExceptionController::class);
Route::resource('pasien', PasienController::class);
Route::resource('kunjungan', KunjunganController::class);

Route::resource('penjadwalan', PenjadwalanController::class);

Route::post('upload-excel' , [PenjadwalanController::class , 'uploadJadwal'])->name('uploadJadwal');

Route::get('get-user-by-id-desa/{id}', [JsonController::class, 'getUserByIdDesa'])->name('getUserByIdDesa');
Route::get('get-user-by-nama-desa/{id}', [JsonController::class, 'getUserByNamaDesa'])->name('getUserByNamaDesa');

Route::get('get-jadwal-by-desa', [JsonController::class, 'getJadwalByDesa'])->name('getJadwalByDesa');
Route::get('get-detail-exception/{id}', [JsonController::class, 'getDetailException'])->name('getDetailException');
Route::get('get-detail-history-exception/{id}', [JsonController::class, 'getDetailHistoryException'])->name('getDetailHistoryException  ');

Route::get('get-detail-pasien/{id}', [JsonController::class, 'getDetailPasien'])->name('getDetailPasien');
Route::get('get-detail-hasil-kunjungan/{id}', [JsonController::class, 'getDetailHasilKunjungan'])->name('getDetailHasilKunjungan');

Route::get('get-all-desa', [JsonController::class, 'getAllDesa'])->name('getAllDesa');
