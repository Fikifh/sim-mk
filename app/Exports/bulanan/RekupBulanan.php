<?php
namespace App\Exports\bulanan;
use Log;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\IndikatorKerja;
use App\Models\User;
use Illuminate\Validation\Rules\In;
use PhpParser\Node\Expr\FuncCall;

class RekupBulanan implements FromCollection, WithHeadings,  WithMapping, WithEvents {

    private $month;
    private $year;
    public function __construct($month = 1, $year =2020){
        $this->month = $month;
        $this->year = $year;
    }

    public function collection(){
        $indikatorKerja = IndikatorKerja::where('users_id', Auth::user()->id)->whereYear('periode', $this->year )->whereMonth('periode', $this->month)->get();
        return $indikatorKerja;
    }
    // public function query()
    // {
        // $bulanan = User::join('indikator_kerjas', 'users.id', 'indikator_kerjas.users_id')
        //     ->join('uraian_kegiatans', 'indikator_kerjas.id', 'uraian_kegiatans.id_indikator_kerjas')
        //     ->join('trans_indikator_kinerjas', 'uraian_kegiatans.id', 'trans_indikator_kinerjas.id_uraian_kegiatan')
        //     ->leftJoin('kehadirans', 'users.id', 'kehadirans.users_id')
        //     ->where('kehadirans.users_id', Auth::user()->id) 
        //     ->where('users.role', 'pegawai')
        //     ->where('users.id', Auth::user()->id)
        //     // ->whereMonth('trans_indikator_kinerjas.created_at', Carbon::now()->month)
        //     // ->whereYear('trans_indikator_kinerjas.created_at', Carbon::now()->year)
        //     ->select([
        //         'users.id',
        //         'users.nama',
        //         'users.golongan',
        //         'users.jabatan',
        //         'users.unit_kerja',
        //         'users.nip',
        //         DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) as pra_nilai_capaian'),
        //         DB::raw('((avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi) / 2 ) + avg(kehadirans.nilai)) / 2) as nilai_capaian'),
        //         DB::raw('avg((uraian_kegiatans.mutu_target + trans_indikator_kinerjas.mutu_realisasi)) as nilai_perhitungan'),
        //         DB::raw('month(trans_indikator_kinerjas.created_at) as month'),
        //         DB::raw('month(kehadirans.bulan) as month_kehadiran'),                
        //     ])->groupBy('month', 'month_kehadiran')->orderBy('month')->get();

    //         $indikatorKerja = DB::table('indikator_kerjas')->where('users_id', Auth::user()->id)->whereYear('periode', $this->year )->whereMonth('periode', $this->month)->get();
    //         return $indikatorKerja;
    // }

    public function map($indikatorKerja): array
    {
        return [
            $indikatorKerja->kegiatan,
            $indikatorKerja->uraianKegiatan->map(function($tugas){
                return [
                    $tugas->uraian_kegiatan,
                    $tugas->ak_target,
                    $tugas->mutu_target,
                    // $tugas->transIndikator ?? $tugas->transIndikator->ak_realisasi,
                    // $tugas->transIndikator ?? $tugas->transIndikator->mutu_realisasi
                ];
            }),
        ];
    }

    public function headings(): array
    {
        return [
            'Indikator Kerja',
            'kegiatan', 
            'ak_target',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }
}