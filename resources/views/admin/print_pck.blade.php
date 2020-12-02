<!DOCTYPE html>
<html lang="en">

<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Aplikasi Rekap Kinerja</title>

    <link rel="shortcut icon" href={{asset('asset/logo_icon.jpg')}} type="image/x-icon">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href={{ asset('bower_components/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}>
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('bower_components/AdminLTE/dist/css/adminlte.min.css') }}>
    <!-- DataTables -->
    <link rel="stylesheet"
        href={{ asset('bower_components/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet"
        href={{ asset('bower_components/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    
    {{-- MDB Bootstrap --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">    
</head>

<body class="hold-transition sidebar-mini">
    <div class="container-fluid" onload="window.print();">
        <div class="row">
            <div class="col-4">
                <table class="" style="margin-bottom:10px;">
                    <?php $user = $indikator_kinerjas->first() ? $indikator_kinerjas->first()->pegawai : null; ?>
                    @if ($user)
                        <tr>
                            <td>1. </td>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <td>2. </td>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $user->nip }}</td>
                        </tr>
                        <tr>
                            <td>3. </td>
                            <td>Pangkat</td>
                            <td>:</td>
                            <td>{{ $user->pangkat }}</td>
                        </tr>
                        <tr>
                            <td>4. </td>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <td>5. </td>
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td>{{ $user->unit_kerja }}</td>
                        </tr>
                    @endif
                </table>                               
            </div>
                        
            {{-- <div class="col-12"> --}}
                @foreach ($indikator_kinerjas as $indikator_kinerja)
                    <div class="col-12">
                        <div class="col-12">
                            <h3 class="card-title text-muted" style="margin-top : 10px;">Indikator Kinerja:
                                {{ $indikator_kinerja->nama }}
                            </h3>                            
                        </div>
                        <!-- /.card-header -->
                        <div class="col-12">
                            {{-- <div class="table-responsive"> --}}
                                <table id="table_sasaran" class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Kegiatan
                                                Tugas Jabatan:</th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">AK</th>
                                            <th colspan="2" style="vertical-align : middle;text-align:center;">Target</th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">AK Realisasi
                                            </th>
                                            <th colspan="2" style="vertical-align : middle;text-align:center;">Realisasi
                                            </th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Perhitungan
                                            </th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Nilai Capaian
                                            </th>
                                        <tr>
                                            <td>Qty</td>
                                            <td>Mutu</td>
                                            <td>Qty</td>
                                            <td>Mutu</td>
                                        </tr>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $perhitungan = 0;
                                        $nilaiCapaian = 0;
                                        $jumlahRow = sizeof($indikator_kinerja->kegiatanTugasJabatan) != 0 ? sizeof($indikator_kinerja->kegiatanTugasJabatan) : 1;
                                        ?>
                                        @foreach ($indikator_kinerja->kegiatanTugasJabatan as $tugasJabatan)
                                            <tr>
                                                <td>
                                                    {{ $i++ . '. ' . $tugasJabatan->uraian_kegiatan }}                                                    
                                                </td>
                                                <td>{{ $tugasJabatan->ak_target }}</td>
                                                <td>{{ $tugasJabatan->qtt_target }}</td>
                                                <td>{{ $tugasJabatan->mutu_target }}</td>
                                                <td>{{ $tugasJabatan->ak_realisasi }}</td>
                                                <td>{{ $tugasJabatan->qty_realisasi }}</td>
                                                <td>{{ $tugasJabatan->mutu_realisasi }}</td>
                                                <td>{{ $tugasJabatan->mutu_target + $tugasJabatan->mutu_realisasi }}</td>
                                                <td>{{ ($tugasJabatan->mutu_target + $tugasJabatan->mutu_realisasi) / 2 }}
                                                </td>
                                                <?php
                                                $perhitungan = $perhitungan + ($tugasJabatan->mutu_target +
                                                $tugasJabatan->mutu_realisasi);
                                                $nilaiCapaian = $nilaiCapaian + ($tugasJabatan->mutu_target +
                                                $tugasJabatan->mutu_realisasi) / 2;                                                
                                                ?>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" style="vertical-align : middle;text-align:center;">Nilai Capaian
                                            </td>
                                            <td>{{ round($perhitungan / $jumlahRow , 3)}}</td>
                                            <td>{{ round($nilaiCapaian  / $jumlahRow, 3)}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            {{-- </div> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endforeach
            {{-- </div> --}}
            <!-- /.col -->

            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title center" style="margin-top :10px;">
                            <?php 
                                $indikatorKerja = $indikator_kinerjas->first();                                
                                ?>
                            REKAPITULASI PENILAIAN CAPAIAN KINERJA 
                            {{-- {{$indikatorKerja != null ? \Carbon\Carbon::parse($indikatorKerja->periode)->format('F Y') : null}} --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_sasaran" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Kegiatan Tugas Jabatan</th>
                                        <th>Perhitugan</th>
                                        <th>Nilai Capaian Kinerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $finalPerhitungan = 0;
                                    $finalNilaiCapaian = 0;
                                    $numOfRow = sizeof($conclusion) != 0 ? sizeof($conclusion) : 1;
                                    ?>
                                    @foreach ($conclusion as $item)
                                        <tr>
                                            <td>{{ $item->indikator_kerja }}</td>
                                            <td>{{ round($item->perhitungan == null ? $item->target : $item->perhitungan, 3) }}</td>
                                            <td>{{ round($item->nilai_capaian == null ? $item->target : $item->nilai_capaian, 3) }}</td>
                                        </tr>
                                        <?php
                                        $finalPerhitungan = $finalPerhitungan + ($item->perhitungan == null ? $item->target : $item->perhitungan);
                                        $finalNilaiCapaian = $finalNilaiCapaian + ( $item->nilai_capaian == null ? $item->target : $item->nilai_capaian);                                        
                                        ?>
                                    @endforeach
                                </tbody>                                
                                <tfoot>
                                    <tr>
                                        <td colspan="0" style="vertical-align : middle;text-align:center;">Hasil Capaian
                                            Kinerja</td>
                                        <td>{{ round($finalPerhitungan / $numOfRow, 3) }}</td>
                                        <td>{{ round($finalNilaiCapaian / $numOfRow, 3) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align : middle;text-align:center;">
                                        </td>
                                        <td>
                                            <?php $nilaiCapaian =
                                            \App\Models\NilaiCapaian::where('nilai_angka_min', '<=',
                                                round($finalNilaiCapaian / $numOfRow, 3)) ->where('nilai_angka', '>=',
                                                round($finalNilaiCapaian / $numOfRow, 3))
                                                ->first(); ?>
                                                @if ($nilaiCapaian)
                                                    {{ $nilaiCapaian->nilai_text }}
                                                @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-12">                                        
                <div class="float-right">                                
                    <table>
                        <tr>
                            <td><p>Pejabat Penilai</p></td>
                        </tr>                                        
                        <tr>                                
                            <td><p></p></td>                                                             
                        </tr>
                        <tr>                                
                            <td><p></p></td>                                                             
                        </tr>
                        <tr>                                
                            <td><p></p></td>                                                          
                        </tr>
                        <tr>                                    
                            <td>Edi Yuniadi</td>
                        </tr>
                        <tr>                                    
                            <td>NIP. 19730601 199402 1 001</td>
                        </tr>
                    </table>
                </div>                        
            </div>
        </div>
    </div>
    <!-- en container fluid -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });
            </script>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- ion icons -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<!-- jQuery -->
<script src={{ asset("bower_components/AdminLTE/plugins/jquery/jquery.min.js") }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset("bower_components/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- DataTables -->
<script src={{ asset("bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}></script>
<script src={{ asset("bower_components/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("bower_components/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}></script>
<script src={{ asset("bower_components/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}></script>
<!-- AdminLTE App -->
<script src={{ asset("bower_components/AdminLTE/dist/js/adminlte.min.js") }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ asset("bower_components/AdminLTE/dist/js/demo.js") }}></script>
<!-- sweet alert -->
<script src= {{ asset("bower_components/AdminLTE/plugins/sweetalert2/sweetalert2.min.js") }}></script>

{{-- MDD Bootstrap --}} 
 <!-- Bootstrap tooltips -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
 <!-- Bootstrap core JavaScript -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
 <!-- MDB core JavaScript -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
</body>
</html>