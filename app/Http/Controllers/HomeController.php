<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorKerja;
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
        $data = ['name' => 'fiki firmansyah'];
        return view('admin_template')->with($data);
    }

    /**
     * menampilkan kegiatan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kegiatan()
    {
        $data['kegiatans'] = IndikatorKerja::whereMonth('periode', Carbon::now()->month)->whereYear('periode', Carbon::now()->year)->get();
        $data['i'] = 1;
        return view('admin.kegiatan')->with($data);
    }

    public function kegiatanDelete(Request $req){
        $kegiatan = IndikatorKerja::find($req->id);
        if($kegiatan){
            $kegiatan->delete();                        
            return redirect()->route('kegiatan')->with(['success' => 'Berhasil menghapus kegiatan !']);
        }
        return redirect()->route('kegiatan')->with(['error' => 'Gagal menghapus kegiatan !']);
    }

    public function tambahKegiatan(Request $req) {
        try{
            $kegiatan = new IndikatorKerja();
            $kegiatan->kegiatan = $req->nama_kegiatan;
            $kegiatan->periode = $req->periode;
            $kegiatan->users_id = Auth::user()->id;
            $kegiatan->save();
            if($kegiatan){
                $uraianKegiatan = new UraianKegiatan();
                $uraianKegiatan->id_indikator_kerjas = $kegiatan->id;
                $uraianKegiatan->uraian_kegiatan = $req->uraian;
                $uraianKegiatan->ak_target = $req->ak_target;
                $uraianKegiatan->qtt_target = $req->qtt_target;
                $uraianKegiatan->mutu_target = $req->mutu_target;
                $uraianKegiatan->save();
                if($uraianKegiatan){
                    return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
                }
                return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
            }
            return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
        }catch(Exception $err) {
            return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
        }
    }

}
