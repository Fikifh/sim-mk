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
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereMonth('periode', Carbon::parse($periode)->month)->whereYear('periode', $year)->get();            
            $conclusion = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
                    ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                    
                    ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
                    ->where('users.id', $userId)       
                    ->whereYear('indikator_kerjas.periode', $year)                    
                    ->whereMonth('indikator_kerjas.periode', Carbon::parse($periode)->month)                    
                    ->select([
                        'users.id',
                        'users.nama',
                        'users.golongan',
                        'users.jabatan',
                        'users.unit_kerja',
                        'users.nip',
                        'indikator_kerjas.nama as indikator_kerja',
                        DB::raw('avg(uraian_kegiatans.mutu_target) as target'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                        DB::raw('((avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan')
                    ])->groupBy('indikator_kerjas.id')->get();
        } elseif($periode != null && $year == null) {
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereMonth('periode', Carbon::parse($periode)->month)->get();
            $conclusion = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
                    ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                    
                    ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
                    ->where('users.id', $userId)       
                    ->whereMonth('indikator_kerjas.periode', Carbon::parse($periode)->month)                    
                    ->select([
                        'users.id',
                        'users.nama',
                        'users.golongan',
                        'users.jabatan',
                        'users.unit_kerja',
                        'users.nip',
                        'indikator_kerjas.nama as indikator_kerja',
                        DB::raw('avg(uraian_kegiatans.mutu_target) as target'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                        DB::raw('((avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan')
                    ])->groupBy('indikator_kerjas.id')->get();
        } elseif($periode == null && $year != null) {
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereYear('periode', $year)->get();
            $conclusion = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
                    ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                    
                    ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
                    ->where('users.id', $userId)       
                    ->whereYear('indikator_kerjas.periode', $year)                    
                    ->select([
                        'users.id',
                        'users.nama',
                        'users.golongan',
                        'users.jabatan',
                        'users.unit_kerja',
                        'users.nip',
                        'indikator_kerjas.nama as indikator_kerja',
                        DB::raw('avg(uraian_kegiatans.mutu_target) as target'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                        DB::raw('((avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan')
                    ])->groupBy('indikator_kerjas.id')->get();
        } else {
            $indikatorKinerja = IndikatorKerja::where('users_id', $userId)->whereYear('periode', Carbon::now()->year)->get();
            $conclusion = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
                    ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                    
                    ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
                    ->where('users.id', $userId)       
                    ->whereYear('indikator_kerjas.periode', Carbon::now()->year)
                    ->select([
                        'users.id',
                        'users.nama',
                        'users.golongan',
                        'users.jabatan',
                        'users.unit_kerja',
                        'users.nip',                        
                        'indikator_kerjas.nama as indikator_kerja',
                        DB::raw('avg(uraian_kegiatans.mutu_target) as target'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                        DB::raw('((avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan')
                    ])->groupBy('indikator_kerjas.id')->get();
        }
        
        $data['indikator_kinerjas'] = $indikatorKinerja;
        $data['conclusion'] = $conclusion;
        $data['page_title'] = 'Penilaian Capaikan Kinerja';
        $data['i'] = 1;                  
        if($req->is_print){
            return view('admin.print_pck')->with($data);    
        }
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

    public function byid(Request $req) {
        $pck = UraianKegiatan::find($req->id);
        return $pck;
    }

    public function updatePck(Request $req) {        
        $tugasJabatan =  UraianKegiatan::find($req->id);
        if($tugasJabatan)
        {            
            $tugasJabatan->uraian_kegiatan = $req->uraian_kegiatan;
            $tugasJabatan->ak_target = $req->ak_target;
            $tugasJabatan->mutu_target = $req->mutu_target;
            $tugasJabatan->qtt_target = $req->qty_target;
            $tugasJabatan->ak_realisasi = $req->ak_realisasi;
            $tugasJabatan->mutu_realisasi = $req->mutu_realisasi;
            $tugasJabatan->qty_realisasi = $req->qty_realisasi;
            $tugasJabatan->save();
            return redirect()->route('admin_penilaian_capaian_kinerja', ['user_id'=> $req->user_id])->with(['success' => 'berhasil update PCK']);
        } else {
            return redirect()->route('admin_penilaian_capaian_kinerja', ['user_id' => $req->user_id])->with(['info' => 'gagal update pck, data tidak ditemukan !']);
        }         
    }

    public function deletePck(Request $req){        
        $tugasJabatan =  UraianKegiatan::find($req->id);
        if($tugasJabatan)
        {    
            $tugasJabatan->delete();
            return redirect()->route('admin_penilaian_capaian_kinerja', ['user_id'=> $req->user_id])->with(['success' => 'berhasil menghapus PCK']);
        } else {
            return redirect()->route('admin_penilaian_capaian_kinerja', ['user_id' => $req->user_id])->with(['info' => 'gagal menghapus pck, data tidak ditemukan !']);
        }
    }

    public function rekup(Request $req) {

        $rekap = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
                    ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                    
                    ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')                    
                    ->whereYear('indikator_kerjas.periode', $req->tahun)                    
                    ->whereMonth('indikator_kerjas.periode', $req->bulan)                    
                    ->select([
                        'users.id',
                        'users.nama',
                        'users.golongan',
                        'users.jabatan',
                        'users.unit_kerja',
                        'users.nip',                        
                        'indikator_kerjas.periode',
                        DB::raw('avg(uraian_kegiatans.mutu_target) as target'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                        DB::raw('((avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                        DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan')
                    ])->groupBy('users.id')->get();                    

                    $data['rekap'] = $rekap;                    
                    $data['page_title'] = 'Rekapitulasi Penilaian Capaian Kinerja Pegawai';
                    $data['i'] = 1;        
                    $data['bulan'] = $req->bulan;
                    $data['tahun'] = $req->tahun;
                    if($req->is_print){
                        return view('admin.rekap_print')->with($data);    
                    }
                    return view('admin.rekap')->with($data);
    }
}
