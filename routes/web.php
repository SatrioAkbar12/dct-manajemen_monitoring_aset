<?php

use App\Http\Controllers\DokumenController;
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
Route::get('/kendaraan', function () {
    return view('kendaraan.index');
});

Route::get('/tipe-dokumen', [DokumenController::class, 'index']);
Route::post('/tipe-dokumen', [DokumenController::class, 'create']);
Route::get('/tipe-dokumen/{id}/update', [DokumenController::class, 'show']);
Route::post('/tipe-dokumen/{id}/update', [DokumenController::class, 'update']);
Route::get('/tipe-dokumen/{id}/delete', [DokumenController::class, 'del']);
