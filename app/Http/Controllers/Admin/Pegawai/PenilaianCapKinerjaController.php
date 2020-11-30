<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndikatorKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Kehadiran;
use App\Models\UraianKegiatan;

class PenilaianCapKinerjaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        $userId = $req->user_id;
        $periode = $req->periode;
        $year = $req->year;

        if($periode != null && $year != null){
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereMonth('periode', $periode)->whereYear('periode', $year)->get();            
        } elseif($periode != null) {
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereMonth('periode', $periode)->get();
        } else {
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereYear('periode', Carbon::now()->year)->get();
        }

        $data['indikator_kinerjas'] = $indikatorKinerja;
        $data['page_title'] = 'Penilaian Capaikan Kinerja';
        $data['i'] = 1;        
        return view('admin.penilaian_cap_kinerja')->with($data);
    }

    public function createTugasJabatan(Request $req) {
        $tugasJabatan =  new UraianKegiatan();
        $tugasJabatan->id_indikator_kerjas = $req->indikator_kerjas_id;
        $tugasJabatan->uraian_kegiatan = $req->uraian_kegiatan;
        $tugasJabatan->ak_target = $req->ak_target;
        $tugasJabatan->mutu_target = $req->mutu_target;
        $tugasJabatan->qtt_target = $req->qty_target;
        $tugasJabatan->ak_realisasi = $req->ak_realisasi;
        $tugasJabatan->mutu_realisasi = $req->mutu_realisasi;
        $tugasJabatan->qty_realisasi = $req->qty_realisasi;
        if($tugasJabatan->save()){
            return redirect()->route('admin_penilaian_capaian_kinerja', ['user_id' => $req->user_id])->with(['success' => 'Berhasil menambahkan Kegiatan Tugas Jabatan ! ']);
        } else {
            return redirect()->route('admin_penilaian_capaian_kinerja')->with(['warning' => 'Gagal menambahkan Kegiatan Tugas Jabatan ! ']);
        }
    }
}
