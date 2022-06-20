<?php

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
Route::match(['post', 'get'], '/', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::group(['prefix' => 'admin'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\AdminController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\AdminController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
});

Route::group(['prefix' => 'pedagang'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PedagangController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PedagangController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PedagangController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\PedagangController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PedagangController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\PedagangController::class, 'destroy']);
});

Route::group(['prefix' => 'pegawai'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PegawaiController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PegawaiController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PegawaiController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\PegawaiController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PegawaiController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\PegawaiController::class, 'destroy']);
});

Route::group(['prefix' => 'kios'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KiosController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KiosController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KiosController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KiosController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KiosController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KiosController::class, 'destroy']);
});

Route::group(['prefix' => 'sarana'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\SaranaController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\SaranaController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\SaranaController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\SaranaController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\SaranaController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\SaranaController::class, 'destroy']);

});

Route::group(['prefix' => 'keluhan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KeluhanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KeluhanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KeluhanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KeluhanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KeluhanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KeluhanController::class, 'destroy']);
});

Route::group(['prefix' => 'jadwal'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\JadwalController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\JadwalController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\JadwalController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\JadwalController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\JadwalController::class, 'destroy']);
    Route::post( '/append', [\App\Http\Controllers\Admin\JadwalController::class, 'append_jadwal_pegawai']);
    Route::get( '/data', [\App\Http\Controllers\Admin\JadwalController::class, 'data_jadwal_pegawai']);
    Route::post( '/delete-jadwal', [\App\Http\Controllers\Admin\JadwalController::class, 'delete_data_jadwal_pegawai']);
    Route::post( '/append/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'append_jadwal_pegawai_detail']);
    Route::get( '/data/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'data_jadwal_pegawai_detail']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'jadwal_detail_page']);
    Route::get( '/detail/{id}/cetak', [\App\Http\Controllers\Admin\JadwalController::class, 'jadwal_detail_cetak']);
});

Route::group(['prefix' => 'pengajuan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PengajuanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PengajuanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PengajuanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PengajuanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\PengajuanController::class, 'destroy']);
    Route::match(['post', 'get'], '/proses/{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'proses']);
});

Route::group(['prefix' => 'laporan-pengajuan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PengajuanController::class, 'laporan_pengajuan']);
    Route::get( '/data', [\App\Http\Controllers\Admin\PengajuanController::class, 'laporan_pengajuan_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\PengajuanController::class, 'laporan_pengajuan_cetak']);
});

Route::group(['prefix' => 'laporan-keluhan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KeluhanController::class, 'laporan_page']);
    Route::get( '/data', [\App\Http\Controllers\Admin\KeluhanController::class, 'get_data_laporan_keluhan']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\KeluhanController::class, 'cetak_laporan_keluhan']);
});


Route::group(['prefix' => 'keluhan-saya'], function () {
    Route::get( '/', [\App\Http\Controllers\Pedagang\KeluhanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Pedagang\KeluhanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Pedagang\KeluhanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Pedagang\KeluhanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Pedagang\KeluhanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Pedagang\KeluhanController::class, 'destroy']);
});
