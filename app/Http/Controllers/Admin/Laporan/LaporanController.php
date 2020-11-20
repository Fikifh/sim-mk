<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndikatorKerja;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $req) {
        if($req->from && $req->to){
            $data['from'] = $req->from;
            $data['to'] = $req->to;
        }
        $pegawai = null;
        $laporan = null;
        $indikatorKerja = [];
        $dataPegawai = null;
        if($req->pegawai_id && $req->from && $req->to){            
            $dataPegawai = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
            ->leftJoin('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
            ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
            ->where('users.role', 'pegawai')
            ->where('users.status', 1)
            ->whereBetween('indikator_kerjas.periode', [$req->from, $req->to])
            ->where('users.id', $req->pegawai_id)            
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                DB::raw('((avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan'),
                DB::raw('avg(kehadirans.nilai) as kehadiran')
            ])->groupBy('users.id')->get();                            
        } else {
            $dataPegawai = User::leftJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
            ->leftJoin('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
            ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
            ->where('users.role', 'pegawai')
            ->where('users.status', 1)            
            ->where('users.id', $req->pegawai_id)            
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                DB::raw('((avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan'),
                DB::raw('avg(kehadirans.nilai) as kehadiran')
            ])->groupBy('users.id')->get();                
        }
        if(count($dataPegawai) > 0){
            $pegawai = $dataPegawai[0];
        }            
        if($req->from && $req->to){
            $indikatorKerja = IndikatorKerja::where('users_id', $req->pegawai_id)->whereBetween('periode', [$req->from, $req->to])->get();                            
        }
        $data ['pegawai_id'] = $req->pegawai_id;
        $data['pegawai'] = $pegawai;
        $data['i'] = 1;
        $data['page_title'] = 'Laporan '     .\Carbon\Carbon::parse($req->from)->format('d M Y')." sampai ". \Carbon\Carbon::parse($req->to)->format('d M Y'); 
        $data['indikator_kerja']  = $indikatorKerja; 
        $data['from'] = $req->from;
        $data['to'] = $req->to;
        $data['pegawai_id'] = $req->pegawai_id;
        if($req->is_print){
            return view('admin.print_laporan')->with($data);
        }      
        return view('admin.laporan')->with($data);
    }
}
