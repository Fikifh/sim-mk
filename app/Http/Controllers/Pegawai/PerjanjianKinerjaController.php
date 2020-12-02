<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SasaranKegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\IndikatorKerja;

class PerjanjianKinerjaController extends Controller
{
    public function index(Request $req)
    {
        $userId = Auth::user()->id;
        if($req->year != null){
            $sasaranKegiatan = SasaranKegiatan::whereYear('sasaran_kegiatan.created_at', $req->year)->rightJoin('indikator_kerjas', 'sasaran_kegiatan.id', 'indikator_kerjas.sasaran_kegiatan_id')
                ->where('indikator_kerjas.users_id', $userId)
                ->select([
                    "sasaran_kegiatan.id",
                    "sasaran_kegiatan.nama as nama",                    
                    "sasaran_kegiatan.created_by",
                    "sasaran_kegiatan.created_at",
                    "sasaran_kegiatan.updated_at",                    
                    "indikator_kerjas.periode",
                    "indikator_kerjas.mutu",
                    "indikator_kerjas.qty",
                    "indikator_kerjas.satuan",
                    "indikator_kerjas.pagu_anggaran",
                    "indikator_kerjas.users_id",
                ])->get();    
        } else {
            $sasaranKegiatan = SasaranKegiatan::whereYear('sasaran_kegiatan.created_at', Carbon::now()->year)->rightJoin('indikator_kerjas', 'sasaran_kegiatan.id', 'indikator_kerjas.sasaran_kegiatan_id')
                ->where('indikator_kerjas.users_id', $userId)
                ->select([
                    "sasaran_kegiatan.id",
                    "sasaran_kegiatan.nama as nama",                    
                    "sasaran_kegiatan.created_by",
                    "sasaran_kegiatan.created_at",
                    "sasaran_kegiatan.updated_at",                    
                    "indikator_kerjas.periode",
                    "indikator_kerjas.mutu",
                    "indikator_kerjas.qty",
                    "indikator_kerjas.satuan",
                    "indikator_kerjas.pagu_anggaran",
                    "indikator_kerjas.users_id",
                ])->get();    
        }    
         
        $data['sasaran_kegiatan'] = $sasaranKegiatan;
        $data['page_title'] = 'Penjajian Kinerja';
        $data['i'] = 1;
        $data['j'] = 1;
        $data['user_id'] = $req->user_id;
        $data['year'] = $req->year;
        if($req->is_print){
            return view('pegawai.perjanjian_kerja_print')->with($data);    
        }
        return view('pegawai.perjanjian_kerja')->with($data);
    }

    public function  createSasaran(Request $req)
    {
        $sasaran = new SasaranKegiatan();
        $sasaran->nama = $req->sasaran;
        $sasaran->created_by = Auth::user()->id;
        $sasaran->save();
        return redirect()->route('_perjanjian_kerja')->with(['success' => 'Berhasil menambahkan Sasaran !']);
    }

    public function deleteSasaran(Request $req) {
        $sasaran = SasaranKegiatan::find($req->sasaran_id);
        if ($sasaran) {
            $sasaran->delete();
            return redirect()->route('_perjanjian_kerja')->with(['success' => 'Berhasil menghapus Sasaran !']);
        } else {
            return redirect()->route('_perjanjian_kerja')->with(['info' => 'gagal menghapus Sasaran !' ]);
        }
    }

    public function  updateSasaran(Request $req)
    {        
        $sasaran = SasaranKegiatan::find($req->id);
        if ($sasaran) {
            $sasaran->nama = $req->sasaran;
            $sasaran->created_by = Auth::user()->id;
            $sasaran->save();
            return redirect()->route('_perjanjian_kerja')->with(['success' => 'Berhasil merubah Sasaran !']);
        } else {
            return redirect()->route('_perjanjian_kerja')->with(['info' => 'gagal merubah Sasaran !' ]);
        }
    }

    public function findSasaranById(Request $req) {
        $sasaran = SasaranKegiatan::find($req->id);        
        return $sasaran;
    }

    public function createIndikatorKinerja(Request $req) {                        
        $indikatorKerja = new IndikatorKerja();
        $indikatorKerja->sasaran_kegiatan_id = $req->sasaran_id;
        $indikatorKerja->nama = $req->indikator_kinerja;
        $indikatorKerja->mutu = $req->mutu;
        $indikatorKerja->periode = $req->periode;
        $indikatorKerja->qty = $req->qty;
        $indikatorKerja->satuan = $req->satuan;
        $indikatorKerja->pagu_anggaran = $req->pagu_anggaran;
        $indikatorKerja->users_id = Auth::user()->id;
        $indikatorKerja->created_by = Auth::user()->id;
        $indikatorKerja->save();
        return redirect()->route('_perjanjian_kerja')->with(['success' => 'Berhasil menambahkan Sasaran !']);        
    }

    public function updateIndikatorKinerja(Request $req) {                                
        $indikatorKerja = IndikatorKerja::find($req->update_indikator_sasaran_id);
        if($indikatorKerja){            
            $indikatorKerja->nama = $req->indikator_kinerja;
            $indikatorKerja->mutu = $req->mutu;
            $indikatorKerja->qty = $req->qty;
            $indikatorKerja->satuan = $req->satuan;
            $indikatorKerja->pagu_anggaran = $req->pagu_anggaran;
            $indikatorKerja->users_id = $req->ditugaskan;
            $indikatorKerja->created_by = Auth::user()->id;
            $indikatorKerja->save();
            return redirect()->route('_perjanjian_kerja')->with(['success' => 'Berhasil mengubah indikator kerja !']);
        } else {
            return redirect()->route('_perjanjian_kerja')->with(['info' => 'gagal mengubah indikator kerja ! ']);
        }     
    }

    public function findIndikatorKerja(Request $req) {
        $indikatorKerja = IndikatorKerja::find($req->id);
        return $indikatorKerja;        
    }
    public function deleteIndikator(Request $req) {
        $indikatorKerja = IndikatorKerja::find($req->indikator_id);
        if($indikatorKerja){
            $indikatorKerja->delete();
            return redirect()->route('_perjanjian_kerja')->with(['success' => 'Berhasil menghapus indikator kerja !']);
        } else {
            return redirect()->route('_perjanjian_kerja')->with(['info' => 'gagal menghapus indikator kerja ! ']);
        }      
    }
}
