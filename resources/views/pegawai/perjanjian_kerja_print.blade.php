<!DOCTYPE html>
<html lang="en">

<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">    

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
            {{-- <div class="col-12"> --}}
                <div class="col-12">                    
                    <!-- /.card-header -->                    
                    {{-- <div class="col-12"> --}}
                        <div class="col-12">
                            <table id="table_sasaran" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sasaran Kegiatan</th>
                                        <th rowspan="2">Indikator Kinerja</th>
                                        <th rowspan="2">Target Mutu</th>
                                        <th rowspan="2">Target Qty</th>
                                        <th rowspan="2">Satuan</th>
                                        <th colspan="12" style="vertical-align : middle;text-align:center;">Waktu
                                            Penyelesaian</th>
                                        <th>Anggaran</th>
                                    </tr>
                                    <tr>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Ag</th>
                                        <th>Sept</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                        <th>Rp.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sasaran_kegiatan as $sasaran)
                                        <tr>
                                            <td rowspan={{ $sasaran->indikatorKerjas->count('id') + 1 }}>
                                                {{ $i++ . '. ' . $sasaran->nama }}                                                
                                            </td>
                                        </tr>
                                        @foreach ($sasaran->indikatorKerjas as $indikatorKerja)
                                            <tr>
                                                <td>
                                                    {{ $j++ . '. ' . $indikatorKerja->nama }}                                                   
                                                </td>
                                                <td>{{ $indikatorKerja->mutu }}</td>
                                                <td>{{ $indikatorKerja->qty }}</td>
                                                <td>{{ $indikatorKerja->satuan }}</td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 1)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 2)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 3)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 4)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 5)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 6)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 7)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 8)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 9)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 10)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 11)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (\Carbon\Carbon::parse($indikatorKerja->periode)->month == 12)
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $indikatorKerja->pagu_anggaran }}</td>
                                            </tr>
                                            <?php if ($j == $sasaran->indikatorKerjas->count('id') + 1) {
                                            $j = 1;
                                            } ?>
                                        @endforeach
                                    @endforeach
                                </tbody>                                
                            </table>
                        </div>
                    {{-- </div> --}}
                    <!-- /.card-body -->
                </div>
                <!-- /.col-12-->
                <div class="col-12">
                    <div class="float-right">
                        <p> Jakarta,  {{\Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                    </div>
                </div>
                <div class="col-12">                    
                        <div class="row align-items-center justify-content-center">

                            <div class="col-6" style="padding-left:100px;">
                                <div class="float-left">   
                                    <table>
                                        <tr>
                                                <td><p>Atasan Pejabat Penilai</p></td>
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
                                            <td>Joko Upoyo Pribadi</td>
                                        </tr>
                                        <tr>                                    
                                            <td>NIP. 19690321 199403 1 002</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>           
                            <div class="col-6" >
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
        </div>
    </div>
    <!-- en container fluid -->


</body>  
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $( window ).on( "load",  window.print());
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

</body>
</html>
