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
                                <img id="logo_id"
                                    src="{{url('asset/logo_icon.jpg')}}"
                                    alt="" height="75.590551181px" width="75.590551181px">
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
            <div class="col-12" style="text-align: center;">
                <p class="font-12" style="margin-top: 20px; letter-spacing: 10px;">SURAT TUGAS</p>
                <p class="font-12">NOMOR : {{ $letter_number ?? '' }}</p>
            </div>
        </div>

        {{-- Letter Body --}}
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col-12 body-letter">
                    <p style="text-indent: 30px;">Kami Ketua Pengadilan Negeri Banjar dengan ini menugaskan kepada:</p>
                </div>
                @php
                    $i = 1;
                @endphp
                <div class="col-12 body-letter">
                    <table class="table-width" cellspacing="0" style="border: 1px solid black; margin-left:30px;">
                        <tr>
                            <th class="table-bordered" style="text-align: center;">
                                <p class="font-11">No.</p>
                            </th>
                            <th class="table-bordered" style="text-align: center;">
                                <p class="font-11">Nama</p>
                            </th>
                            <th class="table-bordered" style="text-align: center;">
                                <p class="font-11">Pangkat/Gol.</p>
                            </th>
                            <th class="table-bordered" style="text-align: center;">
                                <p class="font-11">Jabatan</p>
                            </th>
                        </tr>
                        @foreach ($employees as $employee)
                            <tr>
                                <td class="table-bordered" style="text-align: center;">
                                    <p class="font-11">{{ $i }}</p>
                                </td>
                                <td class="table-bordered" style="text-align: center;">
                                    <p class="font-11">{{ $employee->nama }}</p>
                                </td>
                                <td class="table-bordered" style="text-align: center;">
                                    <p class="font-11">{{ $employee->golongan }}</p>
                                </td>
                                <td class="table-bordered" style="text-align: center;">
                                    <p class="font-11">{{ $employee->jabatan }}</p>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </table>
                </div>
                <div class="col-12 body-letter">
                    <p></p>
                    <p style="text-indent: 30px;">{{ $body_letter }}</p>
                    <p style="text-indent: 30px;">Demikian Surat tugas ini kami buat agar dilaksanakan sebagaimana
                        mestinya.</p>
                </div>
                <div class="col-12 body-letter align-right">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                            <table cellspacing="0" style="">
                                <tr>
                                    <td class="" style="text-align: left;">
                                        <p class="font-11">Dikeluarkan di:</p>
                                    </td>
                                    <td class="" style="text-align: left;">
                                        <p class="font-11">Banjar</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" style="text-align: left;">
                                        <p class="font-11">Pada Tanggal:</p>
                                    </td>
                                    <td class="" style="text-align: left;">
                                        <p class="font-11">{{ \Carbon\Carbon::now()->format('d F y') }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" style="text-align: center" colspan="2">
                                        <p class="font-11">Ketua Pengadilan Negeri Banjar,</p><br><br><br>
                                        <p class="font-11">Jan Oktavianus, S.H., M.H.</p>
                                        <p class="font-11">NIP 197410022000121002</p><br>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END TABLE DATA PEGAWAI --}}
    </div>
</body>
<style>
    .body-letter {
        padding-left: 170px;
        padding-right: 170px;
    }

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
