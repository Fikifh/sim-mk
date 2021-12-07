<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\UraianKegiatan;
use App\Models\NilaiCapaian;
use Illuminate\Support\Facades\DB;

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
        return redirect()->route('envelope');
        $bulanan = User::rightJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                    
            ->where('users.role', 'pegawai')                        
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',                
                DB::raw('(avg(uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2  ) /  count(indikator_kerjas.id) as nilai_capaian'),
                DB::raw('avg(uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) as nilai_perhitungan'),
                DB::raw('month(indikator_kerjas.created_at) as month'),                
            ])->groupBy('month')->orderBy('month')->get();        

        $tahunan = User::rightJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')            
            ->where('users.role', 'pegawai')                        
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',                
                DB::raw('(avg(uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2  ) /  count(indikator_kerjas.id) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan'),
                DB::raw('year(indikator_kerjas.created_at) as year'),                
            ])->groupBy('year')->orderBy('year')->get();

        $summaries = User::rightJoin('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')                 
            ->where('users.role', 'pegawai')            
            ->select([                
                DB::raw('(avg(uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi) / 2  ) /  count(indikator_kerjas.id) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + uraian_kegiatans.mutu_realisasi)) as nilai_perhitungan'),                
            ])->get();
        $summary = $summaries->first();
                            
        $monthNames = [];
        $monthlyPerformance = [];
        foreach ($bulanan as $item) {
            $monthNames[] = $this->month($item->month);
            $monthlyPerformance[] = $item->nilai_capaian == null ? 0 : $item->nilai_capaian;
        }


        $yearlyPerformance = [];
        $year =  [];
        foreach ($tahunan as $item) {
            $yearlyPerformance[] = $item->nilai_capaian == null ? 0 : $item->nilai_capaian;
            $year[] = $item->year ==  null ? 0 : $item->year;
        }

        $data['monthly_performance'] = $monthlyPerformance;
        $data['month_names'] = $monthNames;

        $data['kriteria'] = NilaiCapaian::where('nilai_angka_min', '=<', $summary->nilai_capaian)->where('nilai_angka', '=>',  $summary->nilai_capaian)->first();
        $data['summary'] = $summary;

        $data['yearly_performance'] = $yearlyPerformance;
        $data['year'] = $year;
        $data['page_title'] = 'Dashboard';                 

        return view('admin.dashboard')->with($data);
    }

    function month($number)
    {
        $month = 'Jan';
        switch ($number) {
            case 1:
                $month = 'Jan';
                break;
            case 2:
                $month = 'Feb';
                break;
            case 3:
                $month = 'Mar';
                break;
            case 4:
                $month = 'Apr';
                break;
            case 5:
                $month = 'Mei';
                break;
            case 6:
                $month = 'Jun';
                break;
            case 7:
                $month = 'Jul';
                break;
            case 8:
                $month = 'Aug';
            case 9:
                $month = 'Sep';
                break;
            case 10:
                $month = 'Okt';
                break;
            case 11:
                $month = 'Nov';
                break;
            case 12:
                $month = 'Des';
                break;
            default:
                $month = 'null';
        }
        return $month;
    }

    /**
     * menampilkan kegiatan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kegiatan(Request $req)
    {
        $pegawai_id = $req->pegawai_id;        
        $from = Carbon::parse($req->from)->hour(0)->minute(0)->second(0)->toDateTimeString();
        $to =  Carbon::parse($req->to)->hour(0)->minute(0)->second(0)->toDateTimeString();
        if($req->from && $req->to && $pegawai_id){            
            $kegiatan = IndikatorKerja::whereBetween('periode',  [$from, $to])
                ->where('users_id', $req->pegawai_id)->get();
        } elseif($pegawai_id && !$from && !$to )  {            
            $kegiatan = IndikatorKerja::where('users_id', $req->pegawai_id)->get();
        } elseif($req->from && $req->to && !$pegawai_id){            
            $kegiatan = IndikatorKerja::whereBetween('periode',  [$from, $to])->get();
        } else{            
            $kegiatan = IndikatorKerja::whereYear('periode', Carbon::now()->year)->whereYear('periode', Carbon::now()->year)->get();
        }
        $data['kegiatans'] = $kegiatan;
        $data['i'] = 1;
        $data['page_title'] = 'Indikator Kerja';
        $data['pegawais'] = User::where('role', 'pegawai')->select('id', 'nama')->get();
        return view('admin.kegiatan')->with($data);
    }

    public function kegiatanById(Request $req)
    {
        $data = IndikatorKerja::find($req->id);
        if ($data) {
            $data['ditugaskan'] = $data->pegawai ? $data->pegawai->nama : null;
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
            $kegiatan->created_by = Auth::user()->id;
            $kegiatan->users_id = $req->pegawai;
            
            if ($kegiatan->save()) {               
                return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
            }
            return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !'.$err ]);
        }
    }

    /**
     * Uraian
     */
    public function uraianKegiatan(Request $req)
    {
        $data['uraian'] = UraianKegiatan::where('id_indikator_kerjas', $req->id)->get();
        $data['page_title'] = 'Kegiatan Tugas Jabatan';
        $data['i'] = 1;
        $data['kegiatan_id'] = $req->id;
        return view('admin.uraian_kegiatan')->with($data);
    }
    
    public function uraianKegiatanById(Request $req)
    {
        $data = UraianKegiatan::find($req->id);
        return $data;
    }
    

    public function createUraianKegiatan(Request $req)
    {
        try {
            $uraian = new UraianKegiatan();
            $uraian->id_indikator_kerjas = $req->id;
            $uraian->uraian_kegiatan = $req->uraian_kegiatan;
            $uraian->ak_target = $req->ak_target;
            $uraian->qtt_target = $req->qtt_target;
            $uraian->mutu_target = $req->mutu_target;
            $uraian->save();

            return redirect()->route('uraian_kegiatan', ['id' => $req->id])->with(['success' => 'Berhasil menambah uraian kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('uraian_kegiatan', ['id' => $req->id])->with(['error' => 'Gagal menambah uraian kegiatan !']);
        }
    }

    public function editUraianKegiatan(Request $req) {
        try {            
            $uraian = UraianKegiatan::find($req->id);                                    
            $uraian->uraian_kegiatan = $req->uraian_kegiatan;
            $uraian->ak_target = $req->ak_target;
            $uraian->qtt_target = $req->qtt_target;
            $uraian->mutu_target = $req->mutu_target;
            $uraian->save();

            return redirect()->route('uraian_kegiatan', ['id' => $uraian->id_indikator_kerjas])->with(['success' => 'Berhasil mengubah uraian kegiatan !']);
        } catch (\Exception $err) {            
            return redirect()->route('uraian_kegiatan')->with(['error' => 'Gagal mengubah uraian kegiatan ! '.$err]);
        }
    }

    public function deleteUraianKegiatan(Request $req) {
        $uraian = UraianKegiatan::find($req->id);
        if($uraian){
            $uraian->delete();
            return redirect()->route('uraian_kegiatan', ['id' => $req->id_indikator_kerjas])->with(['success' => 'Berhasil menghapus uraian kegiatan !']);
        }
        return redirect()->route('uraian_kegiatan', ['id' => $req->id_indikator_kerjas])->with(['warning' => 'Data tidak dapat ditemukan !']);
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
            return redirect()->route('kegiatan')->with(['error' => 'Gagal merubah kegiatan !' . $err]);
        }
    }
}
