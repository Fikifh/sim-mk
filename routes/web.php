<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('logout', function(){
    Auth::logout();
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/kegiatan', [App\Http\Controllers\HomeController::class, 'kegiatan'])->name('kegiatan')->middleware('role:admin');
Route::post('/kegiatan', [App\Http\Controllers\HomeController::class, 'tambahKegiatan'])->name('add_kegiatan')->middleware('role:admin');
Route::get('/laporan', [App\Http\Controllers\HomeController::class, 'laporanKegiatan'])->name('laporan_kegiatan')->middleware('role:admin');
Route::get('/kegiatan/delete', [App\Http\Controllers\HomeController::class, 'kegiatanDelete'])->name('kegiatan_delete')->middleware('role:admin');

Route::group(['prefix' => 'pegawai', 'namespace' => App\Http\Controllers\Pegawai\PegawaiController::class, 'middleware'=>'role:pegawai'], function($router){
    $router->get('kegiatan', 'PegawaiController@kegiatan')->name('kegiatan_pegawai');
    $router->get('laporan', 'PegawaiController@laporan')->name('laporan_pegawai');
});
