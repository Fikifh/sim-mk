<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use App\Models\IndikatorKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\UraianKegiatan;
use Illuminate\Support\Facades\Exception;
use App\Http\Controllers\Controller;
use App\Models\TransIndikatoriKinerja;
use File;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
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
    public function index(Request $req)
    {
        $data['pegawai'] = User::where('role', 'pegawai')->get();
        if ($req->is_api) {
            return response()->json($data, 200);
        } else {
            $data['page_title'] = 'Pegawai';
            return view('dashboard')->with($data);
        }
    }

    /**
     * menampilkan kegiatan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kegiatan(Request $req)
    {
        $pegawai_id = $req->pegawai_id;        
        $user_id = Auth::user()->id;        
        $from = Carbon::parse($req->from)->hour(0)->minute(0)->second(0)->toDateTimeString();
        $to =  Carbon::parse($req->to)->hour(0)->minute(0)->second(0)->toDateTimeString();
        if($req->from && $req->to){                      
            $kegiatan = IndikatorKerja::where('users_id', $user_id)->whereBetween('periode',  [$from, $to])->get();
        } else{                        
            $kegiatan = IndikatorKerja::where('users_id', $user_id)->whereMonth('periode', Carbon::now()->month)->whereYear('periode', Carbon::now()->year)->get();
        }
        $data['kegiatans'] = $kegiatan;
        $data['i'] = 1;
        $data['page_title'] = 'Kegiatan';
        $data['pegawai'] = User::where('role', 'pegawai')->select('id', 'nama')->get();
        return view('pegawai.kegiatan')->with($data);
    }

    public function detail(Request $req)
    {
        $kegiatan = IndikatorKerja::find($req->id);
        if ($kegiatan) {
            $data['kegiatan'] = $kegiatan;
            $data['i'] = 1;
            $data['page_title'] = 'Detail Kegiatan';
            $data['uraian'] = $kegiatan->uraianKegiatan;
            $data['trans_indikator'] = $kegiatan->uraianKegiatan;
            return view('pegawai.kegiatan_detail')->with($data);
        }
        return redirect()->route('kegiatan')->with(['info' => 'tidak dapat menemukan data!']);
    }

    public function createLaporan(Request $req)
    {
        try {
            $transIndikatorKinerja = new TransIndikatoriKinerja();
            $transIndikatorKinerja->users_id = Auth::user()->id;
            $transIndikatorKinerja->id_uraian_kegiatan = $req->id;
            $transIndikatorKinerja->ak_realisasi = $req->ak_realisasi;
            $transIndikatorKinerja->mutu_realisasi = $req->mutu_realisasi;
            $transIndikatorKinerja->qtt_realisasi = count($req->reportfile);
            $transIndikatorKinerja->keterangan = $req->keterangan;
            $transIndikatorKinerja->save();
            $id = $transIndikatorKinerja->uraianKegiatan->id_indikator_kerjas;
            $oldPath = "/qtt_realisasi/" . $transIndikatorKinerja->id;
            $path = "/qtt_realisasi/" . $transIndikatorKinerja->id;

            $reportFile = $req->file('reportfile');
            $i = 1;
            if (count($reportFile) > 0) {
                foreach ($reportFile as $file) {

                    if (File::exists(public_path($oldPath))) {
                        File::delete(public_path($oldPath));
                    }
                    $uploadedFileName = time() . "reportfile$i." . $file->getClientOriginalExtension();
                    $file->move(public_path($path),  $uploadedFileName);
                }
            }

            return redirect()->route('detail_kegiatan', ['id' => $id])->with(['success' => 'berhasil membuat laporan']);
        } catch (\Exception $err) {
            $uraian = UraianKegiatan::find($req->id);

            $id = $uraian->id_indikator_kerjas;
            return redirect()->route('detail_kegiatan', ['id' => $id])->with(['error' => 'gagal membuat laporan ' . $err]);
        }
    }

    public function editLaporan(Request $req)
    {        
        $transIndikator = TransIndikatoriKinerja::find($req->id);
        if ($transIndikator) {
            $transIndikator->ak_realisasi = $req->ak_realisasi;
            $transIndikator->mutu_realisasi = $req->mutu_realisasi;
            $transIndikator->keterangan = $req->keterangan;
            $transIndikator->save();
            return redirect()->route('detail_kegiatan', ['id' => $transIndikator->uraianKegiatan->id_indikator_kerjas])->with(['success' => 'berhasil merubah laporan']);
        }
        return redirect()->route('detail_kegiatan')->with(['warning' => 'laporan tidak dapat ditemukan!']);
    }

    
    public function byId(Request $req)
    {
        $transIndikator = TransIndikatoriKinerja::find($req->id);
        if ($transIndikator) {
            return $transIndikator;
        }
        return null;
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
}
