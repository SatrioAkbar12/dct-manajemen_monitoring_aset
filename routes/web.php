<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MasaAktifDokumenController;
use App\Http\Controllers\PeminjamanAktifController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RiwayatPeminjamanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
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

Route::middleware('auth')->controller(UserController::class)->prefix('user')->name('user.')->group(function() {
    Route::middleware('permission:user.index')->get('/', 'index')->name('index');
    Route::middleware('permission:user.store')->post('/', 'store')->name('store');
    Route::middleware('permission:user.update')->get('/{id}', 'show')->name('show');
    Route::middleware('permission:user.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:user.updateRole')->post('/{id}/role', 'updateRole')->name('updateRole');
    Route::middleware('permission:user.del')->post('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(RoleController::class)->prefix('roles')->name('roles.')->group(function() {
    Route::middleware('permission:user.index')->get('/', 'index')->name('index');
    Route::middleware('permission:user.store')->post('/', 'store')->name('store');
    Route::middleware('permission:user.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:user.del')->post('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(PermissionController::class)->prefix('permission')->name('permission.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/sync', 'permissionSync')->name('permissionSync');
});

Route::middleware('auth')->controller(RolePermissionController::class)->prefix('role-permission')->name('rolePermission.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{id_role}', 'detail')->name('detail');
    Route::post('/{id_role}', 'store')->name('store');
    Route::post('/{id_role}/del', 'del')->name('del');
});

Route::middleware('auth')->controller(KendaraanController::class)->prefix('kendaraan')->name('kendaraan.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/{id}', 'update')->name('update');
    Route::post('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(DokumenController::class)->prefix('tipe-dokumen')->name('tipeDokumen.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/{id}', 'update')->name('update');
    Route::post('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(MasaAktifDokumenController::class)->prefix('masa-aktif-dokumen')->name('masaAktifDokumen.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{id_kendaraan}', 'getKendaraan')->name('getKendaraan');
    Route::post('/{id_kendaraan}', 'store')->name('store');
    Route::post('/{id_kendaraan}/{id}', 'update')->name('update');
    Route::post('/{id_kendaraan}/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(ServisRutinKendaraanController::class)->prefix('servis-rutin')->name('servisRutin.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{id_kendaraan}', 'getKendaraan')->name('getKendaraan');
    Route::post('/{id_kendaraan}', 'store')->name('store');
});

Route::middleware('auth')->controller(PeminjamanAktifController::class)->prefix('peminjaman-aktif')->name('peminjamanAktif.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'returning')->name('returning');
    Route::post('/{id}', 'update')->name('update');
});

Route::middleware('auth')->controller(RiwayatPeminjamanController::class)->prefix('riwayat-peminjaman')->name('riwayatPeminjaman.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'detail')->name('detail');
});
