<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndikatorKerja;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        $data['pegawai'] = User::where('role', 'pegawai')->where('status', 1)->get();
        if ($req->is_api) {
            return response()->json($data, 200);
        } else {
            $data['page_title'] = 'Pegawai';
            $data['i'] = 1;
            return view('admin.pegawai')->with($data);
        }
    }

    public function created(Request $req)
    {
        try {
            $pegawai = new User();
            $pegawai->nip = $req->nip;
            $pegawai->nama = $req->nama;
            $pegawai->email = $req->email;
            $pegawai->role = 'pegawai';
            $pegawai->goglongan = $req->goglongan;
            $pegawai->unit_kerja = $req->unit_kerja;
            $pegawai->jabatan = $req->jabatan;
            if ($pegawai->save()) {
                return redirect()->route('admin_pegawai')->with(['success' => 'berhasil menambahkan pegawai']);
            }
        } catch (\Exception $err) {
            return redirect()->route('admin_pegawai')->with(['error' => 'gagal menambahkan pegawai']);
        }
    }
}
