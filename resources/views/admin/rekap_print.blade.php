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
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <table class="" style="margin-bottom:10px;">
                    <?php 
                    $bulan = $rekap->first() ? \Carbon\Carbon::parse($rekap->first()->periode)->month : null; 
                    $tahun = $rekap->first() ? \Carbon\Carbon::parse($rekap->first()->periode)->year : null; 
                    $date = $rekap->first() ? \Carbon\Carbon::parse($rekap->first()->periode)->format('M Y') : null; 
                    
                    ?>                
                    <tr>
                        <td>{{$date}}</td>                        
                    </tr>                                            
                </table>                               
            </div>            
            {{-- <div class="col-12">                 --}}
                    <div class="col-12">                        
                            <h3 class="card-title text-muted" style="margin-top : 10px;">{{$page_title}}</h3>                            
                    </div>               
                        <!-- /.card-header -->
                        <div class="col-12">
                            {{-- <div class="table-responsive"> --}}
                                <table id="table_sasaran" class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="vertical-align : middle;text-align:center;">Nama</th>
                                            <th style="vertical-align : middle;text-align:center;">AK</th>
                                            <th style="vertical-align : middle;text-align:center;">Jabatan</th>
                                            <th style="vertical-align : middle;text-align:center;">Capaian Kinerja
                                            </th>
                                            <th style="vertical-align : middle;text-align:center;">Keterangan
                                            </th>
                                        <tr>                                    
                                    </thead>
                                    <tbody>                                        
                                        @foreach ($rekap as $item)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    {{$item->nama }}                                                    
                                                </td>
                                                <td>{{ $item->ak_target }}</td>
                                                <td>{{ $item->jabatan }}</td>
                                                <td>{{ round($item->nilai_capaian, 3) }}
                                                    <?php 
                                                    $nilaiCapaian = \App\Models\NilaiCapaian::where('nilai_angka_min', '<=', round($item->nilai_capaian, 3)) ->where('nilai_angka', '>=', round($item->nilai_capaian, 3))->first(); 
                                                    ?>
                                                            @if ($nilaiCapaian)
                                                                ({{ $nilaiCapaian->nilai_text }})
                                                            @endif
                                                </td>
                                                <td></td>                                                                                                                                                
                                            </tr>
                                        @endforeach
                                    </tbody>                                    
                                </table>
                            {{-- </div> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->                
            {{-- </div> --}}
            <!-- /.col -->
        </div>
    </div>
    <!-- en container fluid -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });

    </script>
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
