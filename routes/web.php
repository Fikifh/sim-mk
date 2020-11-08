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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/kegiatan', [App\Http\Controllers\HomeController::class, 'kegiatan'])->name('kegiatan')->middleware('role:admin');
Route::get('/kegiatan/id', [App\Http\Controllers\HomeController::class, 'kegiatanById'])->name('kegiatan_by_id')->middleware('role:admin');
Route::post('/kegiatan', [App\Http\Controllers\HomeController::class, 'tambahKegiatan'])->name('add_kegiatan')->middleware('role:admin');
Route::post('/kegiatan/edit', [App\Http\Controllers\HomeController::class, 'editKegiatan'])->name('edit_kegiatan')->middleware('role:admin');
Route::get('/laporan', [App\Http\Controllers\HomeController::class, 'laporanKegiatan'])->name('laporan_kegiatan')->middleware('role:admin');
Route::get('/kegiatan/delete', [App\Http\Controllers\HomeController::class, 'kegiatanDelete'])->name('kegiatan_delete')->middleware('role:admin');
Route::get('/kegiatan/uraian', [App\Http\Controllers\HomeController::class, 'uraianKegiatan'])->name('uraian_kegiatan')->middleware('role:admin');
Route::post('/kegiatan/uraian', [App\Http\Controllers\HomeController::class, 'createUraianKegiatan'])->name('add_uraian_kegiatan')->middleware('role:admin');
Route::post('/kegiatan/uraian/edit', [App\Http\Controllers\HomeController::class, 'editUraianKegiatan'])->name('edit_uraian_kegiatan')->middleware('role:admin');
Route::get('/kegiatan/uraian/id', [App\Http\Controllers\HomeController::class, 'uraianKegiatanById'])->name('uraian_kegiatan_by_id')->middleware('role:admin');
Route::get('/kegiatan/uraian/delete', [App\Http\Controllers\HomeController::class, 'deleteUraianKegiatan'])->name('uraian_kegiatan_delete')->middleware('role:admin');



Route::group(['prefix' => 'admin/pegawai', 'namespace' => 'App\Http\Controllers\Admin\Pegawai'], function($router){
    $router->get('/', 'PegawaiController@index')->name('admin_pegawai');
    $router->get('id', 'PegawaiController@byId')->name('admin_id_pegawai');
    $router->post('/', 'PegawaiController@create')->name('add_admin_pegawai');
    $router->post('update', 'PegawaiController@update')->name('edit_admin_pegawai');
    $router->get('delete', 'PegawaiController@delete')->name('delete_admin_pegawai');

    $router->get('detail', 'PegawaiController@detail')->name('detail_admin_pegawai');
    $router->get('kegiatan', 'PegawaiController@kegiatanByUser')->name('detail_admin_pegawai');
    $router->get('kegiatan/detail', 'PegawaiController@detailKegiatanPegawai')->name('detail_admin_pegawai_kegiatan');
    
});


Route::group(['prefix' => 'pegawai', 'namespace' => 'App\Http\Controllers\Pegawai'], function($router){
    $router->get('/', 'PegawaiController@index')->name('pegawai');
    $router->get('dashboard', 'PegawaiController@dashboard')->name('dashboard_pegawai');
    $router->get('kegiatan', 'PegawaiController@kegiatan')->name('kegiatan_pegawai');
    $router->get('detail', 'PegawaiController@detail')->name('detail_kegiatan');
    $router->get('laporan', 'PegawaiController@laporan')->name('laporan_pegawai');
    $router->post('laporkan', 'PegawaiController@createLaporan')->name('laporkan');
    $router->post('edit_laporan', 'PegawaiController@editLaporan')->name('edit_laporan');
    $router->get('laporan_by_id', 'PegawaiController@byId')->name('laporan_by_id');
    $router->post('add_kegiatan', 'PegawaiController@addKegiatan')->name('pegawai_add_kegiatan');
    $router->get('uraian_kegiatan', 'PegawaiController@uraianKegiatan')->name('pegawai_uraian_kegiatan');
    $router->post('uraian_kegiatan', 'PegawaiController@addUraianKegiatan')->name('pegawai_add_uraian_kegiatan');
    $router->post('edit_uraian_kegiatan', 'PegawaiController@editUraianKegiatan')->name('pegawai_edit_uraian_kegiatan');
    $router->get('uraian_kegiatan_by_id', 'PegawaiController@uraianById')->name('pegawai_getbyid_uraian_kegiatan');
    $router->get('delelte_uraian_kegiatan', 'PegawaiController@deleteUraianKegiatan')->name('delete_pegawai_uraian_kegiatan');
    

});
