<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\UraianKegiatan;
use Illuminate\Support\Facades\Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = ['page_title' => 'Dashboard'];
        return view('dashboard')->with($data);
    }

    /**
     * menampilkan kegiatan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kegiatan(Request $req)
    {

        $data['kegiatans'] = IndikatorKerja::whereMonth('periode', Carbon::now()->month)->whereYear('periode', Carbon::now()->year)->get();
        $data['i'] = 1;
        $data['page_title'] = 'Kegiatan';
        $data['pegawais'] = User::where('role', 'pegawai')->select('id', 'nama')->get();
        return view('admin.kegiatan')->with($data);
    }

    public function kegiatanById(Request $req)
    {
        $data = IndikatorKerja::find($req->id);        
        if ($data) {            
            $data['ditugaskan'] = $data->user->nama;
            $data['uraian_kegiatan'] = $data->uraianKegiatan ? $data->uraianKegiatan->uraian_kegiatan : null;
            $data['ak_target'] = $data->uraianKegiatan ? $data->uraianKegiatan->ak_target : null;
            $data['qtt_target'] = $data->uraianKegiatan ? $data->uraianKegiatan->qtt_target : null;
            $data['mutu_target'] = $data->uraianKegiatan ? $data->uraianKegiatan->mutu_target : null;
            $data['ditugaskan'] = $data->user ? $data->user->nama : null;
            return $data;
        }
        return redirect()->route('kegiatan')->with(['info' => 'data tidak ditemukan!']);
    }

    public function kegiatanDelete(Request $req)
    {
        $kegiatan = IndikatorKerja::find($req->id);
        if ($kegiatan) {
            $kegiatan->delete();
            return redirect()->route('kegiatan')->with(['success' => 'Berhasil menghapus kegiatan !']);
        }
        return redirect()->route('kegiatan')->with(['error' => 'Gagal menghapus kegiatan !']);
    }

    public function tambahKegiatan(Request $req)
    {
        try {
            $kegiatan = new IndikatorKerja();
            $kegiatan->kegiatan = $req->nama_kegiatan;
            $kegiatan->periode = $req->periode;
            $kegiatan->users_id = Auth::user()->id;
            $kegiatan->save();
            if ($kegiatan) {
                $uraianKegiatan = new UraianKegiatan();
                $uraianKegiatan->id_indikator_kerjas = $kegiatan->id;
                $uraianKegiatan->uraian_kegiatan = $req->uraian;
                $uraianKegiatan->ak_target = $req->ak_target;
                $uraianKegiatan->qtt_target = $req->qtt_target;
                $uraianKegiatan->mutu_target = $req->mutu_target;
                $uraianKegiatan->save();
                if ($uraianKegiatan) {
                    return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
                }
                return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
            }
            return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
        }
    }

    public function editKegiatan(Request $req)
    {        
        try {
            $kegiatan = IndikatorKerja::find($req->id);
            $kegiatan->kegiatan = $req->nama_kegiatan;
            $kegiatan->periode = $req->periode;
            $kegiatan->users_id = $req->ditugaskan;
            $kegiatan->save();
            if ($kegiatan->uraianKegiatan) {
                $kegiatan->uraianKegiatan->uraian_kegiatan = $req->uraian;
                $kegiatan->uraianKegiatan->ak_target = $req->ak_target;
                $kegiatan->uraianKegiatan->qtt_target = $req->qtt_target;
                $kegiatan->uraianKegiatan->mutu_target = $req->mutu_target;                
                if ($kegiatan->uraianKegiatan->save()) {
                    return redirect()->route('kegiatan')->with(['success' => 'Berhasil merubah kegiatan !']);
                }
                return redirect()->route('kegiatan')->with(['success' => 'Berhasil merubah kegiatan !']);
            } else {
                $uraianKegiatan = new UraianKegiatan();
                $uraianKegiatan->uraian_kegiatan = $req->uraian;
                $uraianKegiatan->ak_target = $req->ak_target;
                $uraianKegiatan->qtt_target = $req->qtt_target;
                $uraianKegiatan->mutu_target = $req->mutu_target; 
                $uraianKegiatan->id_indikator_kerjas = $kegiatan->id;                
                if ($uraianKegiatan->save()) {
                    return redirect()->route('kegiatan')->with(['success' => 'Berhasil merubah kegiatan !']);
                }
                return redirect()->route('kegiatan')->with(['success' => 'Berhasil merubah kegiatan !']);
            }
            return redirect()->route('kegiatan')->with(['error' => 'Gagal merubah kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('kegiatan')->with(['error' => 'Gagal merubah kegiatan !'.$err]);
        }
    }
}
