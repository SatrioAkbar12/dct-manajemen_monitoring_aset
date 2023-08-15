<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MasaAktifDokumenController;
use App\Http\Controllers\PeminjamanAktifController;
use App\Http\Controllers\PeminjamanAktifToolController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RiwayatPeminjamanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ServisRutinKendaraanController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ToolsGroupController;
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
    Route::middleware('permission:permission.index')->get('/', 'index')->name('index');
    Route::middleware('permission:permission.permissionSync')->get('/sync', 'permissionSync')->name('permissionSync');
});

Route::middleware('auth')->controller(RolePermissionController::class)->prefix('role-permission')->name('rolePermission.')->group(function() {
    Route::middleware('permission:rolePermission.index')->get('/', 'index')->name('index');
    Route::middleware('permission:rolePermission.detail')->get('/{id_role}', 'detail')->name('detail');
    Route::middleware('permission:rolePermission.store')->post('/{id_role}', 'store')->name('store');
    Route::middleware('permission:rolePermission.del')->post('/{id_role}/del', 'del')->name('del');
});

Route::middleware('auth')->controller(JenisKendaraanController::class)->prefix('jenis-kendaraan')->name('jenisKendaraan.')->group(function() {
    Route::middleware('permission:jenisKendaraan.index')->get('/', 'index')->name('index');
    Route::middleware('permission:jenisKendaraan.store')->post('/', 'store')->name('store');
    Route::middleware('permission:jenisKendaraan.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:jenisKendaraan.del')->post('/{id}/del', 'del')->name('del');
});

Route::middleware('auth')->controller(KendaraanController::class)->prefix('kendaraan')->name('kendaraan.')->group(function() {
    Route::middleware('permission:kendaraan.index')->get('/', 'index')->name('index');
    Route::middleware('permission:kendaraan.store')->post('/', 'store')->name('store');
    Route::middleware('permission:kendaraan.show')->get('/{id}', 'show')->name('show');
    Route::middleware('permission:kendaraan.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:kendaraan.del')->post('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(DokumenController::class)->prefix('tipe-dokumen')->name('tipeDokumen.')->group(function() {
    Route::middleware('permission:tipeDokumen.index')->get('/', 'index')->name('index');
    Route::middleware('permission:tipeDokumen.store')->post('/', 'store')->name('store');
    Route::middleware('permission:tipeDokumen.show')->get('/{id}', 'show')->name('show');
    Route::middleware('permission:tipeDokumen.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:tipeDokumen.del')->post('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(MasaAktifDokumenController::class)->prefix('masa-aktif-dokumen')->name('masaAktifDokumen.')->group(function() {
    Route::middleware('permission:masaAktifDokumen.index')->get('/', 'index')->name('index');
    Route::middleware('permission:masaAktifDokumen.getKendaraan')->get('/{id_kendaraan}', 'getKendaraan')->name('getKendaraan');
    Route::middleware('permission:masaAktifDokumen.store')->post('/{id_kendaraan}', 'store')->name('store');
    Route::middleware('permission:masaAktifDokumen.update')->post('/{id_kendaraan}/{id}', 'update')->name('update');
    Route::middleware('permission:masaAktifDokumen.del')->post('/{id_kendaraan}/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(ServisRutinKendaraanController::class)->prefix('servis-rutin')->name('servisRutin.')->group(function() {
    Route::middleware('permission:servisRutin.index')->get('/', 'index')->name('index');
    Route::middleware('permission:servisRutin.getKendaraan')->get('/{id_kendaraan}', 'getKendaraan')->name('getKendaraan');
    Route::middleware('permission:servisRutin.store')->post('/{id_kendaraan}', 'store')->name('store');
});

Route::middleware('auth')->controller(PeminjamanAktifController::class)->prefix('peminjaman-aktif')->name('peminjamanAktif.')->group(function() {
    Route::middleware('permission:peminjamanAktif.index')->get('/', 'index')->name('index');
    Route::middleware('permission:peminjamanAktif.store')->post('/', 'store')->name('store');
    Route::middleware('permission:peminjamanAktif.returning')->get('/{id}', 'returning')->name('returning');
    Route::middleware('permission:peminjamanAktif.update')->post('/{id}', 'update')->name('update');
});

Route::middleware('auth')->controller(RiwayatPeminjamanController::class)->prefix('riwayat-peminjaman')->name('riwayatPeminjaman.')->group(function() {
    Route::middleware('permission:riwayatPeminjaman.index')->get('/', 'index')->name('index');
    Route::middleware('permission:riwayatPeminjaman.detail')->get('/{id}', 'detail')->name('detail');
});

Route::middleware('auth')->controller(AsetController::class)->prefix('aset')->name('aset.')->group(function() {
    Route::middleware('permission:aset.index')->get('/', 'index')->name('index');
    Route::middleware('permission:aset.detail')->get('/{id}', 'detail')->name('detail');
});

Route::middleware('auth')->controller(GudangController::class)->prefix('gudang')->name('gudang.')->group(function() {
    Route::middleware('permission:gudang.index')->get('/', 'index')->name('index');
    Route::middleware('permission:gudang.store')->post('/', 'store')->name('store');
    Route::middleware('permission:gudang.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:gudang.del')->delete('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(ToolsGroupController::class)->prefix('tools-group')->name('toolsGroup.')->group(function() {
    Route::middleware('permission:toolsGroup.index')->get('/', 'index')->name('index');
    Route::middleware('permission:toolsGroup.store')->post('/', 'store')->name('store');
    Route::middleware('permission:toolsGroup.update')->post('/{id}', 'update')->name('update');
    Route::middleware('permission:toolsGroup.del')->delete('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(ToolController::class)->prefix('tools')->name('tools.')->group(function() {
    Route::middleware('permission:tools.index')->get('/', 'index')->name('index');
    Route::middleware('permission:tools.store')->post('/', 'store')->name('store');
    Route::middleware('permission:tools.detail')->get('/{id}', 'detail')->name('detail');
    Route::middleware('permission:tools.edit')->get('/{id}/edit', 'edit')->name('edit');
    Route::middleware('permission:tools.update')->post('/{id}/update', 'update')->name('update');
    Route::middleware('permission:tools.del')->delete('/{id}/delete', 'del')->name('del');
});

Route::middleware('auth')->controller(PeminjamanAktifToolController::class)->prefix('peminjaman-aktif-tools')->name('peminjamanAktifTools.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'returning')->name('returning');
    Route::post('/{id}', 'update')->name('update');
});
