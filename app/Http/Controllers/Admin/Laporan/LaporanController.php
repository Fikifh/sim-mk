<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $req) {
        if($req->from && $req->to){
            $data['from'] = $req->from;
            $data['to'] = $req->to;
        }
        if($req->pegawai_id){
            $data ['pegawai_id'] = $req->pegawai_id;
        }
        
        $data['page_title'] = 'Laporan';
        return view('admin.laporan')->with($data);
    }
}
