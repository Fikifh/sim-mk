<?php

namespace App\Http\Controllers\Admin\Pegawai;

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
        if($req->year != null){
            $sasaranKegiatan = SasaranKegiatan::whereYear('created_at', $req->year)->get();    
        } else {
            $sasaranKegiatan = SasaranKegiatan::whereYear('created_at', Carbon::now()->year)->get();
        }                

        $data['sasaran_kegiatan'] = $sasaranKegiatan;
        $data['page_title'] = 'Penjajian Kinerja';
        $data['i'] = 1;
        $data['j'] = 1;
        $data['user_id'] = $req->user_id;
        $data['year'] = $req->year;
        if($req->is_print){
            return view('admin.perjanjian_kerja_print')->with($data);    
        }
        return view('admin.perjanjian_kerja')->with($data);
    }

    public function  createSasaran(Request $req)
    {
        $sasaran = new SasaranKegiatan();
        $sasaran->nama = $req->sasaran;
        $sasaran->created_by = Auth::user()->id;
        $sasaran->save();
        return redirect()->route('perjanjian_kerja')->with(['success' => 'Berhasil menambahkan Sasaran !']);
    }

    public function deleteSasaran(Request $req) {
        $sasaran = SasaranKegiatan::find($req->sasaran_id);
        if ($sasaran) {
            $sasaran->delete();
            return redirect()->route('perjanjian_kerja')->with(['success' => 'Berhasil menghapus Sasaran !']);
        } else {
            return redirect()->route('perjanjian_kerja')->with(['info' => 'gagal menghapus Sasaran !' ]);
        }
    }

    public function  updateSasaran(Request $req)
    {        
        $sasaran = SasaranKegiatan::find($req->id);
        if ($sasaran) {
            $sasaran->nama = $req->sasaran;
            $sasaran->created_by = Auth::user()->id;
            $sasaran->save();
            return redirect()->route('perjanjian_kerja')->with(['success' => 'Berhasil merubah Sasaran !']);
        } else {
            return redirect()->route('perjanjian_kerja')->with(['info' => 'gagal merubah Sasaran !' ]);
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
        $indikatorKerja->periode = $req->periode;
        $indikatorKerja->mutu = $req->mutu;
        $indikatorKerja->qty = $req->qty;
        $indikatorKerja->satuan = $req->satuan;
        $indikatorKerja->pagu_anggaran = $req->pagu_anggaran;
        $indikatorKerja->users_id = $req->ditugaskan;
        $indikatorKerja->created_by = Auth::user()->id;
        $indikatorKerja->save();
        return redirect()->route('perjanjian_kerja')->with(['success' => 'Berhasil menambahkan Sasaran !']);        
    }

    public function updateIndikatorKinerja(Request $req) {                                
        $indikatorKerja = IndikatorKerja::find($req->update_indikator_sasaran_id);
        if($indikatorKerja){            
            $indikatorKerja->nama = $req->indikator_kinerja;
            $indikatorKerja->mutu = $req->mutu;
            $indikatorKerja->qty = $req->qty;
            $indikatorKerja->satuan = $req->satuan;
            $indikatorKerja->periode = $req->periode;
            $indikatorKerja->pagu_anggaran = $req->pagu_anggaran;
            $indikatorKerja->users_id = $req->ditugaskan;
            $indikatorKerja->created_by = Auth::user()->id;
            $indikatorKerja->save();
            return redirect()->route('perjanjian_kerja')->with(['success' => 'Berhasil mengubah indikator kerja !']);
        } else {
            return redirect()->route('perjanjian_kerja')->with(['info' => 'gagal mengubah indikator kerja ! ']);
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
            return redirect()->route('perjanjian_kerja')->with(['success' => 'Berhasil menghapus indikator kerja !']);
        } else {
            return redirect()->route('perjanjian_kerja')->with(['info' => 'gagal menghapus indikator kerja ! ']);
        }      
    }
}
