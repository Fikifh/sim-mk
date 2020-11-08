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
use App\Models\NilaiCapaian;
use File;
use Illuminate\Support\Facades\DB;

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
     */
    public function dashboard(Request $req)
    {        
        $bulanan = User::join('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
            ->leftJoin('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
            ->where('users.role', 'pegawai')
            ->where('users.id', Auth::user()->id)
            // ->whereMonth('trans_indikator_kinerjas.created_at', Carbon::now()->month)
            // ->whereYear('trans_indikator_kinerjas.created_at', Carbon::now()->year)
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan'),
                DB::raw('month(trans_indikator_kinerjas.created_at) as month')
            ])->groupBy('month')->orderBy('month')->get();

        $tahunan = User::join('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
            ->leftJoin('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
            ->where('users.role', 'pegawai')
            ->where('users.id', Auth::user()->id)
            // ->whereYear('trans_indikator_kinerjas.created_at', Carbon::now()->year)
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan'),
                DB::raw('year(trans_indikator_kinerjas.created_at) as year')
            ])->groupBy('year')->orderBy('year')->get();

        $summary = User::join('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
            ->leftJoin('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
            ->where('users.role', 'pegawai')
            ->where('users.id', Auth::user()->id)
            ->select([
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan'),
            ])->first();
                
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

        $data['kriteria'] = NilaiCapaian::where('nilai_angka_min', '<=', $summary->nilai_capaian)->where('nilai_angka', '>=',  $summary->nilai_capaian)->first();
        $data['summary'] = $summary;

        $data['yearly_performance'] = $yearlyPerformance;
        $data['year'] = $year;
        $data['page_title'] = 'Dashboard';

        return view('dashboard')->with($data);
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
     * menambahkan kegiatan
     */
    public function addKegiatan(Request $req)
    {
        try {
            $my_id = Auth::user()->id;
            $kegiatan = new IndikatorKerja();
            $kegiatan->kegiatan = $req->nama_kegiatan;
            $kegiatan->periode = $req->periode;
            $kegiatan->created_by = $my_id;
            $kegiatan->users_id = $my_id;

            if ($kegiatan->save()) {
                return redirect()->route('kegiatan_pegawai')->with(['success' => 'Berhasil menambah kegiatan !']);
            }
            return redirect()->route('kegiatan_pegawai')->with(['error' => 'Gagal menambah kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('kegiatan_pegawai')->with(['error' => 'Gagal menambah kegiatan !' . $err]);
        }
    }

    /**
     * menampilkan kegiatan
     */
    public function kegiatan(Request $req)
    {
        $pegawai_id = $req->pegawai_id;
        $user_id = Auth::user()->id;
        $from = Carbon::parse($req->from)->hour(0)->minute(0)->second(0)->toDateTimeString();
        $to =  Carbon::parse($req->to)->hour(0)->minute(0)->second(0)->toDateTimeString();
        if ($req->from && $req->to) {
            $kegiatan = IndikatorKerja::where('users_id', $user_id)->whereBetween('periode',  [$from, $to])->get();
        } else {
            $kegiatan = IndikatorKerja::where('users_id', $user_id)->whereMonth('periode', Carbon::now()->month)->whereYear('periode', Carbon::now()->year)->get();
        }
        $data['kegiatans'] = $kegiatan;
        $data['i'] = 1;
        $data['page_title'] = 'Kegiatan';
        $data['pegawai'] = User::where('role', 'pegawai')->select('id', 'nama')->get();
        return view('pegawai.kegiatan')->with($data);
    }

    /**
     * Menampilkan Uraian Kegiatan
     */
    public function uraianKegiatan(Request $req)
    {
        $data['uraian'] = UraianKegiatan::where('id_indikator_kerjas', $req->id)->get();
        $data['page_title'] = 'Uraian kegiatan';
        $data['i'] = 1;
        $data['kegiatan_id'] = $req->id;
        return view('pegawai.uraian_kegiatan')->with($data);
    }

    /**
     * get uraian by id
     */
    public function uraianById(Request $req)
    {
        $uraian = uraianKegiatan::find($req->id);
        return $uraian;
    }

    /**
     * edit uraian by id
     */
    public function editUraianKegiatan(Request $req)
    {
        try {
            $uraian = UraianKegiatan::find($req->id);
            $uraian->uraian_kegiatan = $req->uraian_kegiatan;
            $uraian->ak_target = $req->ak_target;
            $uraian->qtt_target = $req->qtt_target;
            $uraian->mutu_target = $req->mutu_target;
            $uraian->save();

            return redirect()->route('pegawai_uraian_kegiatan', ['id' => $uraian->id_indikator_kerjas])->with(['success' => 'Berhasil mengubah uraian kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('pegawai_uraian_kegiatan')->with(['error' => 'Gagal mengubah uraian kegiatan ! ' . $err]);
        }
    }

    public function deleteUraianKegiatan(Request $req)
    {
        $uraian = UraianKegiatan::find($req->id);
        if ($uraian) {
            $uraian->delete();
            return redirect()->route('pegawai_uraian_kegiatan', ['id' => $uraian->id_indikator_kerjas])->with(['success' => 'Berhasil menghapus uraian kegiatan !']);
        }
        return redirect()->route('pegawai_uraian_kegiatan', ['id' => $req->id_indikator_kerjas])->with(['warning' => 'Data tidak dapat ditemukan !']);
    }

    /**
     * Menambahkan Uraian Kegiatan
     */
    public function addUraianKegiatan(Request $req)
    {
        try {
            $uraian = new UraianKegiatan();
            $uraian->id_indikator_kerjas = $req->id;
            $uraian->uraian_kegiatan = $req->uraian_kegiatan;
            $uraian->ak_target = $req->ak_target;
            $uraian->qtt_target = $req->qtt_target;
            $uraian->mutu_target = $req->mutu_target;
            $uraian->save();

            return redirect()->route('pegawai_uraian_kegiatan', ['id' => $req->id])->with(['success' => 'Berhasil menambah uraian kegiatan !']);
        } catch (\Exception $err) {
            return redirect()->route('pegawai_uraian_kegiatan', ['id' => $req->id])->with(['error' => 'Gagal menambah uraian kegiatan !']);
        }
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

    // public function tambahKegiatan(Request $req)
    // {
    //     try {
    //         $kegiatan = new IndikatorKerja();
    //         $kegiatan->kegiatan = $req->nama_kegiatan;
    //         $kegiatan->periode = $req->periode;
    //         $kegiatan->users_id = Auth::user()->id;
    //         $kegiatan->save();
    //         if ($kegiatan) {
    //             $uraianKegiatan = new UraianKegiatan();
    //             $uraianKegiatan->id_indikator_kerjas = $kegiatan->id;
    //             $uraianKegiatan->uraian_kegiatan = $req->uraian;
    //             $uraianKegiatan->ak_target = $req->ak_target;
    //             $uraianKegiatan->qtt_target = $req->qtt_target;
    //             $uraianKegiatan->mutu_target = $req->mutu_target;
    //             $uraianKegiatan->save();
    //             if ($uraianKegiatan) {
    //                 return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
    //             }
    //             return redirect()->route('kegiatan')->with(['success' => 'Berhasil menambah kegiatan !']);
    //         }
    //         return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
    //     } catch (\Exception $err) {
    //         return redirect()->route('kegiatan')->with(['error' => 'Gagal menambah kegiatan !']);
    //     }
    // }
}
