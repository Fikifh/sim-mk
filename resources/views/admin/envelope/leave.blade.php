<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body onpageshow="window.print()">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="row line-bottom">
                <div class="col-12">
                    <table>
                        <tr width="">
                            <td rowspan="4">
                                <img id="logo_id" src="{{ url('asset/logo_icon.jpg') }}" alt=""
                                    height="75.590551181px" width="75.590551181px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <p class="font-18" style="font-weight: bold;">PENGADILAN NEGERI BANJAR KELAS II
                                </p>
                                <p class="font-12">Jalan Brigjen M isa Nomor 145, Telp. (0265) 748 1792</p>
                                <p class="font-11">Email : pnkotabanjar@gmail.com</p>
                                <p class="font-14" style="font-weight: bold;">BANJAR</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- End Header --}}


        <div class="row">
            <div class="col-12">
                <table style="margin-left: 565px;">
                    <tr>
                        <td style="text-align: left">
                            <p class="font-12">Banjar, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                            <p class="font-12">Kepada Yth. :</p>
                            <p class="font-12">Ketua Pengadilan Negeri Banjar</p>
                            <p class="font-12">di</p>
                            <p class="font-12">Banjar</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12" style="text-align: center;">
                <p class="font-12" style="margin-top: 20px;">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</p>
                <p class="font-12">NOMOR : {{ $letter_number ?? '' }}</p>
            </div>
        </div>

        {{-- Table DATA PEGAWAI --}}
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0">
                        <tr>
                            <td class="table-bordered" colspan="4">
                                <p class="font-12">I. DATA PEGAWAI</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered">
                                <p class="font-12">NAMA</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-12">{{ $employee->nama ? $employee->nama : '' }}</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-12">NIP</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-12">{{ $employee->nip ? $employee->nip : '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered">
                                <p class="font-12">Jabatan</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-12">{{ $employee->jabatan ? $employee->jabatan : '' }}</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-12">Masa Kerja</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-12">{{ $work_long ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered">
                                <p class="font-12">Unit Kerja</p>
                            </td>
                            <td class="table-bordered" colspan="4">
                                <p class="font-12">{{ $employee->unit_kerja ?? '' }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END TABLE DATA PEGAWAI --}}

        {{-- Table JENIS CUTI --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="4">
                                <p class="font-11">II. JENIS CUTI</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered">
                                <p class="font-11">{{ $leave_type }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END TABLE JENIS CUTI --}}

        {{-- Table ALASAN CUTI --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="4">
                                <p class="font-11">III. ALASAN CUTI</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" colspan="4">
                                <p class="font-11">{{ $leave_reason ?? '' }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END ALASAN CUTI --}}

        {{-- Table LAMANYA CUTI --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="6">
                                <p class="font-11">IV. LAMANYA CUTI</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 50px;">
                                <p class="font-11">Selama</p>
                            </td>
                            <td class="table-bordered" style="width: 130px; text-align:center;">
                                <p class="font-11">
                                    {{ \Carbon\Carbon::parse($leave_date_from)->diffInDays($leave_date_to) }} Hari
                                </p>
                            </td>
                            <td class="table-bordered" style="width: 100px;">
                                <p class="font-11">Mulai Tanggal</p>
                            </td>
                            <td class="table-bordered" style="width: 130px;">
                                <p class="font-11">
                                    {{ \Carbon\Carbon::parse($leave_date_from)->format('d F Y') }}</p>
                            </td>
                            <td class="table-bordered" style="text-align: center">
                                <p class="font-11">s.d</p>
                            </td>
                            <td class="table-bordered" style="width: 130px;">
                                <p class="font-11">
                                    {{ \Carbon\Carbon::parse($leave_date_to)->format('d F Y') }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END LAMANYA CUTI --}}

        {{-- CATATAN CUTI --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="6">
                                <p class="font-11">V. CATATAN CUTI</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" colspan="3" style="width: 40px;">
                                <p class="font-11">1. CUTI TAHUNAN</p>
                            </td>
                            <td class="table-bordered" rowspan="2" style="text-align: center">
                                <p class="font-11">Paraf</p>
                                <p class="font-11">Petugas Cuti</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-11">2. CUTI BESAR</p>
                            </td>
                            <td class="table-bordered" style="width: 30px">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="text-align: center;">
                                <p class="font-11">TAHUN</p>
                            </td>
                            <td class="table-bordered" style="text-align: center;">
                                <p class="font-11">SISA</p>
                            </td>
                            <td class="table-bordered" style="width: 40px; text-align:center;">
                                <p class="font-11">KETERANGAN</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-11">3. CUTI SAKIT</p>
                            </td>
                            <td class="table-bordered" style="width: 30px;">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                        @php
                            $currentYear = \Carbon\Carbon::now()->year;
                        @endphp
                        <tr>
                            <td class="table-bordered" style="width: 20px; text-align:center;">
                                <p class="font-11">{{ $currentYear - 2 }}</p>
                            </td>
                            <td class="table-bordered" style="width: 40px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 40px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" rowspan="3" style="width: 50px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 60px;">
                                <p class="font-11">4. CUTI MELAHIRKAN</p>
                            </td>
                            <td class="table-bordered" style="width: 30px;">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 20px; text-align:center;">
                                <p class="font-11">{{ $currentYear - 1 }}</p>
                            </td>
                            <td class="table-bordered" style="width: 40px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 40px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 80px;">
                                <p class="font-11">4. CUTI KARENA ALASAN PENTING</p>
                            </td>
                            <td class="table-bordered" style="width: 30px;">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 20px; text-align:center;">
                                <p class="font-11">{{ $currentYear }}</p>
                            </td>
                            <td class="table-bordered" style="width: 40px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 40px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 80px;">
                                <p class="font-11">5. CUTI DILUAR TANGGUNG JAWAB NEGARA</p>
                            </td>
                            <td class="table-bordered" style="width: 30px;">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END CATATAN CUTI --}}

        {{-- ALAMAT SELAMA MENJALANKAN CUTI --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="3">
                                <p class="font-11">VI. ALAMAT SELAMA MENJALANKAN CUTI</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 300px;">
                                <p class="font-11">{{ $leave_address }}</p>
                            </td>
                            <td class="table-bordered" style="width: 100px;">
                                <p class="font-11">TELP</p>
                            </td>
                            <td class="table-bordered">
                                <p class="font-11">{{ $leave_phone ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 300px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="text-align: center" colspan="2">
                                <p class="font-11">Hormat Saya</p><br><br><br>
                                <p class="font-11">{{ $employee->nama }}</p>
                                <p class="font-11">NIP {{ $employee->nip }}</p><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END ALAMAT SELAMA MENJALANKAN CUTI --}}

        {{-- PERTIMBANGAN ATASAN LANGSUNG --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="4">
                                <p class="font-11">VII. PERTIMBANGAN ATASAN LANGSUNG**</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Disetujui</p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Perubahan***</p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Ditangguhkan***</p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Tidak Disetujui***</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="" style="width: 300px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="" style="width: 300px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="text-align: center" colspan="3">
                                <p class="font-11">Sekretaris Pengadilan Negeri Banjar,</p><br><br><br>
                                <p class="font-11">Santi Sofia Damayanti, S.S., S.H., M.M.</p>
                                <p class="font-11">NIP 19208222006042002</p><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END PERTIMBANGAN ATASAN LANGSUNG --}}

        {{-- KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI --}}
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <div class="row">
                <div class="col-12">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black;">
                        <tr>
                            <td class="table-bordered" colspan="4">
                                <p class="font-11">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI**</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Disetujui</p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Perubahan***</p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Ditangguhkan***</p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11">Tidak Disetujui***</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="width: 200px;">
                                <p class="font-11"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="no-table-bordered" style="width: 300px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="no-table-bordered" style="width: 300px;">
                                <p class="font-11"></p>
                            </td>
                            <td class="table-bordered" style="text-align: center" colspan="3">
                                <p class="font-11">
                                    {{ $assigner ? $assigner->jabatan : 'Ketua Pengadilan Negeri Banjar' }},
                                </p><br><br><br>
                                <p class="font-11">
                                    {{ $assigner ? $assigner->nama : 'Agus Ardianto, S.H., M.H.' }}</p>
                                <p class="font-11">
                                    {{ $assigner ? $assigner->nip : 'NIP 197708242001121002' }}</p><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- END KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI --}}

        {{-- Envelope Header --}}
        {{-- <div class="d-flex justify-content-center">
            <div class="row line-bottom">
                <div class="col-1">
                    <img id="logo_id"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQj_G2FIFRiB86YFoSCKCIqMUjU67i-j06a5w&usqp=CAU"
                        alt="" height="75.590551181px" width="75.590551181px">
                </div>
                <div class="col-11 center">
                    <p class="font-18" style="font-weight: bold;">PENGADILAN NEGERI BANJAR KELAS II</p>
                    <p class="font-12">Jalan Brigjen M isa Nomor 145, Telp. (0265) 748 1792</p>
                    <p class="font-11">Email : pnkotabanjar@gmail.com</p>
                    <p class="font-14" style="font-weight: bold;">BANJAR</p>
                </div>
            </div>
        </div> --}}
        {{-- End Envelope Header --}}
        {{-- <div class="d-flex justify-content-end">
            <div class="row">
                <div class="col-11">
                    <p class="font-12">Banjar, {{ \Carbon\Carbon::now()->toDateString() }}</p>
                    <p class="font-12">Kepada Yth. :</p>
                    <p class="font-12">Ketua Pengadilan Negeri Banjar</p>
                    <p class="font-12">di</p>
                    <p class="font-12">Banjar</p>
                </div>
            </div>
        </div> --}}
    </div>
</body>
<style>
    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .font-18 {
        margin-bottom: 1px;
        font-size: 18pt;
    }

    .font-16 {
        margin-bottom: 1px;
        font-size: 16pt;
    }

    .font-14 {
        margin-bottom: 1px;
        font-size: 14pt;
    }

    .font-12 {
        margin-bottom: 1px;
        font-size: 12pt;
    }

    .font-11 {
        margin-bottom: 1px;
        font-size: 11pt;
    }

    .line-bottom {
        border-bottom: 4px solid black;
    }

    .table-bordered {
        border: 1px solid black;
        padding: 1px 2px 1px;
        height: 15px;
    }

    .no-table-bordered {
        border: 0px solid rgb(255, 255, 255);
        padding: 1px 2px 1px;
        height: 15px;
    }

    .table-width {
        width: 587px;
        border: 0px solid black;
    }

    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Times New Roman";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A4;
        margin: 37.795275591px;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        /* ... the rest of the rules ... */
    }

</style>

</html>
