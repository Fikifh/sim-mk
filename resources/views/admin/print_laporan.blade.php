<!DOCTYPE html>
<html lang="en">

<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Kepegawaian MK</title>

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img purple-gradient img-fluid img-circle"
                                src={{ asset('asset/user_icon.png') }} alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $pegawai ? $pegawai->nama : null }}</h3>

                        <p class="text-muted text-center">{{ $pegawai ? $pegawai->jabatan : null }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIP</b> <a class="float-right">{{ $pegawai ? $pegawai->nip : null }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Pangkat/Gol.Ruang</b> <a
                                    class="float-right">{{ $pegawai ? $pegawai->golongan : null }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Unit Kerja</b> <a class="float-right">{{ $pegawai ? $pegawai->unit_kerja : null }}</a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        {{ $pegawai ? round($pegawai->nilai_perhitungan, 2) : null }}
                                    </h5>
                                    <span class="description-text">Perhitungan</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        {{ $pegawai ? round($pegawai->nilai_capaian, 2) : null }}
                                    </h5>
                                    <span class="description-text">Capaian</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $pegawai ? round($pegawai->kehadiran, 2) : null }}
                                    </h5>
                                    <span class="description-text">Kehadiran</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="float-right">
                    <a href="#" target="_blank">
                        <button id="add_kegiatan_id" type="button"
                            class="btn purple-gradient bg-gradient-primary btn-flat add_kegiatan" >
                            <i class="fas fa-print"></i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <!-- /.card-header -->

                @foreach ($indikator_kerja as $item)
                    <div class="card">
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-tasks"></i> Indikator Kerja :</h5>
                                <b> {{ $item->kegiatan }}</b>
                            </div>
                            <!-- /.card-header -->
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kegiatan Tugas Jabatan</th>
                                                <th>AK Target</th>
                                                <th>Qty Target</th>
                                                <th>Mutu Target</th>
                                                <th>AK Realisasi</th>
                                                <th>Qty Realisasi</th>
                                                <th>Mutu Realisasi</th>
                                                <th>Perhitungan</th>
                                                <th>Nilai Perhitungan</th>
                                                <th>Nilai Capaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j = 1; ?>
                                            @foreach ($item->uraianKegiatan as $uraianKegiatan)
                                                <tr>
                                                    <td>{{ $j++ }}</td>
                                                    <td>{{ $uraianKegiatan->uraian_kegiatan }}</td>
                                                    <td>{{ $uraianKegiatan->ak_target }}</td>
                                                    <td>{{ $uraianKegiatan->qtt_target }}</td>
                                                    <td>{{ $uraianKegiatan->mutu_target }}</td>
                                                    <td>{{ $uraianKegiatan->transIndikator ? $uraianKegiatan->transIndikator->ak_realisasi : null }}
                                                    </td>
                                                    <td>{{ $uraianKegiatan->transIndikator ? $uraianKegiatan->transIndikator->qtt_realisasi : null }}
                                                    </td>
                                                    <td>{{ $uraianKegiatan->transIndikator ? $uraianKegiatan->transIndikator->mutu_target : null }}
                                                    </td>
                                                    <?php
                                                    $perhitungan = ($uraianKegiatan->transIndikator ?
                                                    $uraianKegiatan->transIndikator->mutu_target : null) +
                                                    ($uraianKegiatan->transIndikator ?
                                                    $uraianKegiatan->transIndikator->mutu_realisasi : null);
                                                    $capaian = $perhitungan / 2;
                                                    ?>
                                                    <td>{{ round($perhitungan, 2) }}</td>
                                                    <td>{{ round($capaian, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
    <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href={{ url('/admin')}}>Kepegawaian MK</a>.</strong> All rights reserved.
  </footer>
</div>
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
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>