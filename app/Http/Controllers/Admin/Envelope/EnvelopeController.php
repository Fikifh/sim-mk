<?php

namespace App\Http\Controllers\Admin\Envelope;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndikatorKerja;
use Carbon\Carbon;
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

        return view('admin.envelope.envelope', ['page_title' => 'Template Surat', 'envelopes' => $data]);
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
            'leave_type' => $req->leave_type,
            'leave_reason' => $req->leave_reason,
            'leave_date_from' => $req->leave_date_from,
            'leave_date_to' => $req->leave_date_to,
            'leave_address' => $req->leave_address,
            'leave_phone' => $req->leave_phone,
            'letter_number' => $req->letter_number
        ]);
    }

    public function createAssignmentKPKNL(Request $req)
    {
        $employees = User::whereIn('id', $req->employee_ids)->get();
        if (count($employees) < 0) {
            return back()->with(['error' => 'pegawai tidak dapat ditemukan!']);
        }

        return view('admin.envelope.assignment_letter', [
            'first_redaction' => $req->first_redaction,
            'employees' => $employees, 
            'letter_number' => $req->letter_number,
            'body_letter' => $req->body_letter
        ]);
    }

    public function createSpmt(Request $req)
    {
        $employee = User::find($req->employee_id);
        if (!$employee) {
            return back()->with(['error' => 'pegawai tidak dapat ditemukan!']);
        }

        return view('admin.envelope.spmt', [
            'employee' => $employee, 
            'letter_number' => $req->letter_number,
            'sk_number' => $req->sk_number,
            'sk_date' => Carbon::parse($req->sk_date)->isoFormat('D MMMM Y'),
            'sk_date_start' => Carbon::parse($req->sk_date_start)->isoFormat('D MMMM Y'),
            'date_start' => Carbon::parse($req->date_start)->isoFormat('D MMMM Y'),
            'tunjangan' => number_format($req->tunjangan, 0, '', '.'),
            'tunjangan_dibaca' => $req->tunjangan_dibaca
        ]);
    }

    public function createSpmj(Request $req)
    {
        $employee = User::find($req->employee_id);
        if (!$employee) {
            return back()->with(['error' => 'pegawai tidak dapat ditemukan!']);
        }

        return view('admin.envelope.spmj', [
            'employee' => $employee, 
            'letter_number' => $req->letter_number,
            'sk_number' => $req->sk_number,
            'sk_date' => Carbon::parse($req->sk_date)->isoFormat('D MMMM Y'),
            'sk_date_start' => Carbon::parse($req->sk_date_start)->isoFormat('D MMMM Y'),
            'date_start' => Carbon::parse($req->date_start)->isoFormat('D MMMM Y'),
            'tunjangan' => number_format($req->tunjangan, 0, '', '.'),
            'tunjangan_dibaca' => $req->tunjangan_dibaca
        ]);
    }

    public function createSpp(Request $req)
    {
        $employee = User::find($req->employee_id);
        if (!$employee) {
            return back()->with(['error' => 'pegawai tidak dapat ditemukan!']);
        }

        return view('admin.envelope.spp', [
            'employee' => $employee, 
            'letter_number' => $req->letter_number,
            'sk_number' => $req->sk_number,
            'sk_date' => Carbon::parse($req->sk_date)->isoFormat('D MMMM Y'),
            'sk_date_start' => Carbon::parse($req->sk_date_start)->isoFormat('D MMMM Y'),
            'date_start' => Carbon::parse($req->date_start)->isoFormat('D MMMM Y'),
            'tunjangan' => number_format($req->tunjangan, 0, '', '.'),
            'tunjangan_dibaca' => $req->tunjangan_dibaca
        ]);
    }

    
}
