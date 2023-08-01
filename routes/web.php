<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KendaraanController;
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
