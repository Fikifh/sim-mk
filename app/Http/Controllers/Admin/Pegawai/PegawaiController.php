<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndikatorKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->route('admin_pegawai')->with(['error' => 'gagal menambahkan pegawai ']);
        }
    }

    public function update(Request $req)
    {        
        try {
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
        $pegawai = User::find($req->id);
        return $pegawai;
    }

    public function delete(Request $req)
    {
        $pegawai = User::find($req->id);
        if($pegawai){
            $pegawai->status = 0;
            $pegawai->save();
            return redirect()->route('admin_pegawai')->with(['success' => 'berhasil menonaktifkan pegawai']);
        }
        return redirect()->route('admin_pegawai')->with(['error' => 'gagal menonaktifkan pegawai | ']);
    }
}
