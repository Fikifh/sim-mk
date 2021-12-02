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
            <div class="col-12" style="text-align: center;">
                <p class="font-12"
                    style="margin-top: 20px; letter-spacing: 1px; font-weight:bold; text-decoration:underline;">
                    SURAT PERNYATAAN MASIH
                    MELAKSANAKAN TUGAS</p>
                <p class="font-12">NOMOR : {{ $letter_number ?? '' }}</p>
            </div>
        </div>

        {{-- Letter Body --}}
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col-12 body-letter">
                    <p style="text-indent: 30px;">Yang bertanda tangan dibawah ini:</p>
                </div>
                <div class="col-12 body-letter">
                    <table class="table-width" cellspacing="0" style="margin-left:30px;">
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $employeed->nama ? $employeed->nama : 'Kusman, S.H., M.H.' }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>: {{ $employeed->nama ? $employeed->nama : '197610242001121004' }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat / Golongan Ruang</td>
                            <td>: {{ $employeed->nama ? $employeed->nama : 'Pembina / (IV/a)' }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>: {{ $employeed->nama ? $employeed->nama : 'Ketua Pengadilan Negeri Banjar' }}</td>
                        </tr>
                    </table>
                    <p></p>
                    <p style="text-indent: 30px; text-align:justify;">Dengan ini menyatakan dengan sesungguhnya bahwa :
                    </p>
                    <table class="table-width" cellspacing="0" style="margin-left:30px;">
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $employee->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>: {{ $employee->nip }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat / Golongan Ruang</td>
                            <td>: {{ $employee->golongan }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>: {{ $employee->jabatan }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-12 body-letter">
                    <p></p>
                    <p style="text-indent: 30px; text-align:justify;">Berdasarkan surat keputusan Direktur Jenderal
                        Badan Peradilan Umum
                        Nomor: {{ $sk_number }} tanggal {{ $sk_date }} masih melaksanakan tugas tersebut
                        terhitung mulai tanggal {{ $date_start }}</p>
                    <p style="text-indent: 30px; text-align:justify;">Berdasarkan Peraturan Presiden RI Nomor : 24 tahun
                        2007 sdr.
                        {{ $employee->nama }} berhak menerima tunjangan Jabatan Panitera Pengganti Pengadilan Negeri
                        Banjar sebesar Rp.{{ $tunjangan }} {{ $tunjangan_dibaca ? "($tunjangan_dibaca)" : null }}
                        setiap bulannya</p>
                    <p style="text-indent: 30px; text-align:justify;">Demikian Surat Pernyataan ini kami buat dengan
                        sesungguhnya mengingat
                        Sumpah Jabatan Pegawai Negeri Sipil. Apabila dikemudian hari Surat Pernyataan ini ternyata tidak
                        benar yang mengakibatkan kerugian terhadap negara, maka kami bersedia menanggung kerugian
                        tersebut.</p>
                    <p style="text-indent: 30px; text-align:justify;">Asli Surat Pernyataan ini disampaikan kepada
                        Kepala Kantor Pelayanan
                        Perbendaharaan Negara Tasikmalaya.</p>
                </div>
                <div class="col-12 body-letter align-right">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                            <table cellspacing="0" style="">
                                <tr>
                                    <td class="" style="text-align: left;">
                                        <p class="font-11">Banjar,
                                            {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" style="text-align: center" colspan="2">
                                        <p class="font-11">
                                            {{ $employeed->jabatan ? $employeed->jabatan : 'Ketua Pengadilan Negeri Banjar' }},
                                        </p><br><br><br>
                                        <p class="font-11">
                                            {{ $employeed->jabatan ? $employeed->jabatan : 'Kusman, S.H., M.H.' }}</p>
                                        <p class="font-11">NIP
                                            {{ $employeed->jabatan ? $employeed->jabatan : '197610242001121004' }}</p>
                                        <br>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 body-letter align-left">
                    <div class="d-flex flex-row-start">
                        <div class="p-2">
                            <p class="font-footer">Tembusan kepada YTH.</p>
                            <p class="font-footer">1. Ketua Mahkamah Agung RI. di Jakarta;</p>
                            <p class="font-footer">2. Sekretaris Mahkamah Agung RI. di Jakarta;</p>
                            <p class="font-footer">3. Direktur Jenderal Badilum MARI di Jakarta;</p>
                            <p class="font-footer">4. Ketua Pengadilan Tinggi Bandung di Bandung;</p>
                            <p class="font-footer">5. Kepala Badan Kepegawaian Negara Reg III di Bandung;</p>
                            <p class="font-footer">6. Pembuat Daftar Gaji Pengadilan Negeri Banjar di Banjar;</p>
                            <p class="font-footer">7. Pegawai Negeri Sipil yang bersangkutan;</p>
                            <p class="font-footer">8. Arsip;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END TABLE DATA PEGAWAI --}}
    </div>
</body>
<style>
    .font-footer {
        font-size: 9px;
        margin-bottom: 1px;
    }

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
