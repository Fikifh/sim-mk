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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('role:admin');
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

Route::group(['prefix' => 'admin/laporan', 'namespace' => 'App\Http\Controllers\Admin\Laporan'], function($router){
    $router->get('/', 'LaporanController@index')->name('admin_laporan_pegawai');
});

Route::group(['prefix' => 'admin/pegawai', 'namespace' => 'App\Http\Controllers\Admin\Pegawai'], function($router){
    //PCK
    $router->get('penilaian_cap_kinerja', 'PenilaianCapKinerjaController@index')->name('admin_penilaian_capaian_kinerja');
    $router->post('tugas_jabatan', 'PenilaianCapKinerjaController@createTugasJabatan')->name('admin_pegawai_add_tugas_jabatan');
    $router->get('pck/byid', 'PenilaianCapKinerjaController@byid')->name('pck_byid');
    $router->post('pck/update', 'PenilaianCapKinerjaController@updatePck')->name('admin_pegawai_update_pck');
    $router->post('pck/delete', 'PenilaianCapKinerjaController@deletePck')->name('admin_pegawai_delete_pck');    
    //rekup
    $router->get('rekup', 'PenilaianCapKinerjaController@rekup')->name('admin_rekup');        

    //PK
    $router->post('sasaran', 'PerjanjianKinerjaController@createSasaran')->name('pegawai_add_sasaran');
    $router->post('sasaran/update', 'PerjanjianKinerjaController@updateSasaran')->name('pegawai_update_sasaran');
    $router->get('sasaran/byid', 'PerjanjianKinerjaController@findSasaranById')->name('pegawai_get_sasaran_byid');
    $router->get('sasaran/delete', 'PerjanjianKinerjaController@deleteSasaran')->name('pegawai_delete_sasaran');
    $router->get('perjanjian_kinerja', 'PerjanjianKinerjaController@index')->name('perjanjian_kerja');    

    $router->post('indikator/byid', 'PerjanjianKinerjaController@createIndikatorKinerja')->name('admin_add_indikator_kinerja');
    $router->post('indikator/update', 'PerjanjianKinerjaController@updateIndikatorKinerja')->name('admin_update_indikator_kinerja');
    $router->get('indikator/delete', 'PerjanjianKinerjaController@deleteIndikator')->name('admin_delete_indikator');
    
    $router->get('/', 'PegawaiController@index')->name('admin_pegawai');
    $router->get('id', 'PegawaiController@byId')->name('admin_id_pegawai');
    $router->post('/', 'PegawaiController@create')->name('add_admin_pegawai');
    $router->post('update', 'PegawaiController@update')->name('edit_admin_pegawai');
    $router->get('delete', 'PegawaiController@delete')->name('delete_admin_pegawai');

    $router->get('detail', 'PegawaiController@detail')->name('detail_admin_pegawai');
    $router->get('kegiatan', 'PegawaiController@kegiatanByUser')->name('detail_admin_pegawai');
    $router->get('kegiatan/detail', 'PegawaiController@detailKegiatanPegawai')->name('detail_admin_pegawai_kegiatan');
    
});

//PEGAWAI
Route::group(['prefix' => 'pegawai', 'namespace' => 'App\Http\Controllers\Pegawai', 'middleware' => 'auth'], function($router){    
    
    //Pegawai PCK
    $router->get('penilaian_cap_kinerja', 'PenilaianCapKinerjaController@index')->name('pegawai_penilaian_capaian_kinerja');
    $router->post('tugas_jabatan', 'PenilaianCapKinerjaController@createTugasJabatan')->name('pegawai_pegawai_add_tugas_jabatan');
    $router->get('pck/byid', 'PenilaianCapKinerjaController@byid')->name('pck_byid');
    $router->post('pck/update', 'PenilaianCapKinerjaController@updatePck')->name('pegawai_pegawai_update_pck');
    $router->post('pck/delete', 'PenilaianCapKinerjaController@deletePck')->name('pegawai_pegawai_delete_pck');    
    //Pegawai Rekup
    $router->get('rekup', 'PenilaianCapKinerjaController@rekup')->name('pegawai_rekup');        

    //Pegawai PK
    $router->post('sasaran', 'PerjanjianKinerjaController@createSasaran')->name('_pegawai_add_sasaran');
    $router->post('sasaran/update', 'PerjanjianKinerjaController@updateSasaran')->name('_pegawai_update_sasaran');
    $router->get('sasaran/byid', 'PerjanjianKinerjaController@findSasaranById')->name('_pegawai_get_sasaran_byid');
    $router->get('sasaran/delete', 'PerjanjianKinerjaController@deleteSasaran')->name('_pegawai_delete_sasaran');
    $router->get('perjanjian_kinerja', 'PerjanjianKinerjaController@index')->name('_perjanjian_kerja');    

    
    $router->post('indikator/byid', 'PerjanjianKinerjaController@createIndikatorKinerja')->name('pegawai_add_indikator_kinerja');
    $router->post('indikator/update', 'PerjanjianKinerjaController@updateIndikatorKinerja')->name('pegawai_update_indikator_kinerja');
    $router->get('indikator/byid', 'PerjanjianKinerjaController@findIndikatorKerja')->name('find_indikator_kinerja');
    $router->get('indikator/delete', 'PerjanjianKinerjaController@deleteIndikator')->name('pegawai_delete_indikator');
    
    
    $router->get('/', 'PegawaiController@dashboard')->name('dashboard_pegawai');
    $router->get('kegiatan', 'PegawaiController@kegiatan')->name('kegiatan_pegawai');
    $router->get('detail', 'PegawaiController@detail')->name('detail_kegiatan');
    $router->get('laporan', 'LaporanController@laporan')->name('laporan_pegawai');
    $router->post('laporkan', 'PegawaiController@createLaporan')->name('laporkan');
    $router->post('edit_laporan', 'PegawaiController@editLaporan')->name('edit_laporan');
    $router->get('laporan_by_id', 'PegawaiController@byId')->name('laporan_by_id');
    $router->post('add_kegiatan', 'PegawaiController@addKegiatan')->name('pegawai_add_kegiatan');
    $router->get('uraian_kegiatan', 'PegawaiController@uraianKegiatan')->name('pegawai_uraian_kegiatan');
    $router->post('uraian_kegiatan', 'PegawaiController@addUraianKegiatan')->name('pegawai_add_uraian_kegiatan');
    $router->post('edit_uraian_kegiatan', 'PegawaiController@editUraianKegiatan')->name('pegawai_edit_uraian_kegiatan');
    $router->get('uraian_kegiatan_by_id', 'PegawaiController@uraianById')->name('pegawai_getbyid_uraian_kegiatan');
    $router->get('delelte_uraian_kegiatan', 'PegawaiController@deleteUraianKegiatan')->name('delete_pegawai_uraian_kegiatan');
    
    $router->get('report-monthly', 'PegawaiController@reportMonthLy')->name('get_report_monthly');
    

});
