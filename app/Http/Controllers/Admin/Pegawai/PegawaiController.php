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

class PegawaiController extends Controller
{

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
        // $data['pegawai'] = User::where('role', 'pegawai')->where('status', 1)->get();
        $data['pegawai'] = User::join('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
            ->leftJoin('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
            ->leftJoin('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
            ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
            ->where('users.role', 'pegawai')
            ->select([
                'users.id',
                'users.nama',
                'users.golongan',
                'users.jabatan',
                'users.unit_kerja',
                'users.nip',
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
                DB::raw('((avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
                DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan')
            ])->groupBy('users.id')->get();
        if ($req->is_api) {
            return response()->json($data, 200);
        } else {
            $data['page_title'] = 'Pegawai';
            $data['i'] = 1;
            return view('admin.pegawai')->with($data);
        }
    }

    public function create(Request $req)
    {
        try {
            $pegawai = new User();
            $pegawai->nip = $req->nip;
            $pegawai->nama = $req->nama;
            $pegawai->email = $req->email;
            $pegawai->role = 'pegawai';
            $pegawai->golongan = $req->golongan;
            $pegawai->unit_kerja = $req->unit_kerja;
            $pegawai->jabatan = $req->jabatan;
            $pegawai->password = Hash::make($req->password);
            if ($pegawai->save()) {
                return redirect()->route('admin_pegawai')->with(['success' => 'berhasil menambahkan pegawai']);
            }
        } catch (\Exception $err) {
            return redirect()->route('admin_pegawai')->with(['error' => 'gagal menambahkan pegawai  '. $err->getMessage()]);
        }
    }

    public function update(Request $req)
    {
        try {
            if ($req->kehadiran) {
                $user_id = $req->user_id;
                $kehadiran = Kehadiran::whereMonth('bulan', Carbon::now()->month)
                    ->where('users_id', $user_id)
                    ->whereYear('bulan', Carbon::now()->year)->first();
                if ($kehadiran) {
                    $kehadiran->nilai = $req->kehadiran;
                    $kehadiran->save();
                } else {
                    $createKehadiran = new Kehadiran();
                    $createKehadiran->nilai = $req->kehadiran;
                    $createKehadiran->users_id = $user_id;
                    $createKehadiran->bulan = Carbon::now()->toDateString();
                    $createKehadiran->save();
                }
            }
            $pegawai = User::find($req->id);
            $pegawai->nip = $req->nip;
            $pegawai->nama = $req->nama;
            $pegawai->email = $req->email;
            $pegawai->golongan = $req->golongan;
            $pegawai->unit_kerja = $req->unit_kerja;
            $pegawai->jabatan = $req->jabatan;
            $req->password ? $pegawai->password = Hash::make($req->password) : false;
            if ($pegawai->save()) {
                return redirect()->route('admin_pegawai')->with(['success' => 'berhasil merubah pegawai']);
            }
        } catch (\Exception $err) {
            return redirect()->route('admin_pegawai')->with(['error' => 'gagal merubah pegawai | ']);
        }
    }

    public function byId(Request $req)
    {
        $user_id = $req->user_id;
        $pegawai = User::find($req->id);
        $kehadiran = Kehadiran::whereMonth('bulan', Carbon::now()->month)
                    ->where('users_id', $user_id)
                    ->whereYear('bulan', Carbon::now()->year)->first();
        $data['pegawai'] = $pegawai;
        $data ['kehadiran'] = $kehadiran;
        return $data;
    }

    public function delete(Request $req)
    {
        $pegawai = User::find($req->id);
        if ($pegawai) {
            $pegawai->status = 0;
            $pegawai->save();
            return redirect()->route('admin_pegawai')->with(['success' => 'berhasil menonaktifkan pegawai']);
        }
        return redirect()->route('admin_pegawai')->with(['error' => 'gagal menonaktifkan pegawai | ']);
    }

    public function detail(Request $req)
    {
        $from = $req->from;
        $to = $req->to;
        if ($from && $to) {
            $allTaskResult = IndikatorKerja::join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
                ->join('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
                ->where('indikator_kerjas.users_id', $req->user_id)
                ->whereBetween('indikator_kerjas.periode', [$from, $to])

                ->first();
        } elseif ($req->this_month) {
            $allKegiata = IndikatorKerja::where('users_id', $req->user_id)->whereMonth('periode', Carbon::now()->month)->whereYear('periode', Carbon::now()->year)->get();
            $allTaskResult = IndikatorKerja::join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
                ->join('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
                ->where('indikator_kerjas.users_id', $req->user_id)
                ->whereMonth('indikator_kerjas.periode', Carbon::now()->month)
                ->whereYear('indikator_kerjas.periode', Carbon::now()->year)
                ->select([
                    DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as nilai_capaian'),
                    DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan')

                ])->first();
        } else {
            $allKegiata = IndikatorKerja::where('users_id', $req->user_id)->whereMonth('periode', Carbon::now()->month)->whereYear('periode', Carbon::now()->year)->get();
            $allTaskResult = IndikatorKerja::join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
                ->join('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
                ->where('indikator_kerjas.users_id', $req->user_id)
                ->select([
                    DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as nilai_capaian'),
                    DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan')

                ])->first();
        }
        return $allTaskResult;
    }

    public function kegiatanByUser(Request $req)
    {
        if ($req->from &&  $req->to) {
            $data['kegiatan'] = IndikatorKerja::where('users_id', $req->user_id)->whereBetween('periode', [Carbon::parse($req->to)->toDateString(), Carbon::parse($req->from)->toDateString])->get();
        } else {
            $data['kegiatan'] = IndikatorKerja::where('users_id', $req->user_id)->whereYear('periode', Carbon::now()->year)->whereMonth('periode', Carbon::now()->month)->get();
        }
        $data['page_title'] = 'Pegawai / Kegiatan';
        $data['i'] = 1;
        return view('admin.pegawai_kegiatan')->with($data);
    }

    public function detailKegiatanPegawai(Request $req)
    {
        $kegiatan = IndikatorKerja::find($req->id);
        if ($kegiatan) {
            $data['kegiatan'] = $kegiatan;
            $data['i'] = 1;
            $data['page_title'] = 'Detail Kegiatan';
            $data['uraian'] = $kegiatan->uraianKegiatan;
            $data['trans_indikator'] = $kegiatan->uraianKegiatan;
            return view('admin.pegawai_kegiatan_detail')->with($data);
        }
        return redirect()->route('kegiatan_pegawai')->with(['info' => 'tidak dapat menemukan data!']);
    }
}
