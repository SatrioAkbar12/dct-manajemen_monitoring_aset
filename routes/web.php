<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MasaAktifDokumenController;
use App\Http\Controllers\ServisRutinKendaraanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}/update', [UserController::class, 'show']);
Route::post('/user/{id}/update', [UserController::class, 'update']);
Route::get('/user/{id}/delete', [UserController::class, 'del']);

Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::post('/kendaraan', [KendaraanController::class, 'store']);
Route::get('/kendaraan/{id}/update', [KendaraanController::class, 'show']);
Route::post('/kendaraan/{id}/update', [KendaraanController::class, 'update']);
Route::get('/kendaraan/{id}/delete', [KendaraanController::class, 'del']);

Route::get('/tipe-dokumen', [DokumenController::class, 'index']);
Route::post('/tipe-dokumen', [DokumenController::class, 'store']);
Route::get('/tipe-dokumen/{id}/update', [DokumenController::class, 'show']);
Route::post('/tipe-dokumen/{id}/update', [DokumenController::class, 'update']);
Route::get('/tipe-dokumen/{id}/delete', [DokumenController::class, 'del']);

Route::get('/masa-aktif-dokumen', [MasaAktifDokumenController::class, 'index']);
Route::get('/masa-aktif-dokumen/{id_kendaraan}', [MasaAktifDokumenController::class, 'getKendaraan']);
Route::post('/masa-aktif-dokumen/{id_kendaraan}', [MasaAktifDokumenController::class, 'store']);
Route::post('/masa-aktif-dokumen/{id_kendaraan}/{id}', [MasaAktifDokumenController::class, 'update']);
Route::get('/masa-aktif-dokumen/{id_kendaraan}/{id}/delete', [MasaAktifDokumenController::class, 'del']);

Route::get('/servis-rutin', [ServisRutinKendaraanController::class, 'index']);
Route::get('/servis-rutin/{id_kendaraan}', [ServisRutinKendaraanController::class, 'getKendaraan']);
Route::post('/servis-rutin/{id_kendaraan}', [ServisRutinKendaraanController::class, 'store']);
