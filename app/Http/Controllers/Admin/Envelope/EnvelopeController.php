<?php

namespace App\Http\Controllers\Admin\Envelope;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndikatorKerja;
use Illuminate\Support\Facades\DB;

class EnvelopeController extends Controller
{
    public function index(Request $req)
    {
        $data = [
            [
                'id' => 'id_cuti', 'name' => 'Izin Cuti'
            ],
            [
                'id' => 'id_kpknl', 'name' => 'Surat Tugas KPKNL'
            ],
            [
                'id' => 'id_spmt', 'name' => 'Surat Pernyataan Masih Melaksanakan Tugas (SPMT)'
            ],
            [
                'id' => 'id_spmj', 'name' => 'Surat Pernyataan Masih Menduduki Jabatan (SPMJ)'
            ],
            [
                'id' => 'id_spp', 'name' => 'Surat Pernataan Pelantikan (SPP)'
            ],
        ];

        return view('admin.envelope.envelope', ['page_title' => 'Template Surat Menyurat', 'envelopes' => $data]);
    }

    public function createLeave(Request $req)
    {
        $employee = User::find($req->employee_id);
        if (!$employee) {
            return back()->with(['error' => 'pegawai tidak dapat ditemukan!']);
        }
        return view('admin.envelope.leave', [
            'employee' => $employee, 'envelope_number' => $req->envelope_number,
            'work_long' => $req->work_long,
            ''
        ]);
    }
}
