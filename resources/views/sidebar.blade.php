<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="color: #AF5296 !important;">
        <img src={{ asset('asset/logo_icon.jpg') }} alt="sireki"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>
            @if (Auth::user())
                @if(Auth::user()->role == 'admin')
                    Admin
                @else
                    Pegawai
                @endif
            @endif
        </b>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="color: #AF5296 !important;">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('asset/user_icon.png') }}
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">@if(Auth::user())  {{Auth::user()->nama }}@endif</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- Admin Menu -->
                @if (Auth::user()->role == 'admin')
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href={{ route('home') }} class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Menu</li>
                    <li class="nav-item">
                        <a href={{ route('perjanjian_kerja') }} class="nav-link">
                            <i class="far fa-handshake"></i>
                            <p>
                                Perjanjian Kerja (PK)
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#adminPckModal">
                            <i class="fas fa-file-signature"></i>
                            <p>
                                Penilaian Capaian Kinerja (PCK)
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#adminRekapModal">
                            <i class="fas fa-file-invoice"></i>
                            <p>
                                Rekap
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-header">Data Pegawai</li>
                    <li class="nav-item">
                        <a href={{ route('admin_pegawai') }} class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pegawai
                            </p>
                        </a>
                    </li>  
                    <li class="nav-header">Template Surat</li>
                    <li class="nav-item">
                        <a href={{ route('envelope') }} class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Template Surat
                            </p>
                        </a>
                    </li>                   
                @else
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href={{ route('dashboard_pegawai') }} class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Menu</li>
                    <li class="nav-item">
                        <a href={{ route('_perjanjian_kerja') }} class="nav-link">                            
                            <i class="far fa-handshake"></i>
                            <p>
                                Perjanjian Kerja (PK)
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-target="#pegawaiPckModal" data-toggle="modal" class="nav-link" >
                            <i class="fas fa-file-signature"></i>
                            <p>
                                Penilaian Capaian Kinerja (PCK)
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#pegawaiRekapModal">
                            <i class="fas fa-file-invoice"></i>
                            <p>
                                Rekap
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="laporanModal">Lihat Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action={{ url('admin/laporan') }} method="GET">
                    @csrf
                    <input type="text" name="id" class="form-control" id="id" hidden="true">
                    <div class="form-group">
                        <label for="nip" class="control-label">Pegawai :</label>
                        <select name="pegawai_id" class="form-control" required="true" , id="pegawai_id">
                            <option value=""></option>
                        </select>
                        <small class="text-muted">Silahkan pilih pegawai </small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Periode:</label><br>
                        Dari
                        <input type="date" name="from" class="form" required="true" id="periode">
                        Sampai <input type="date" name="to" class="form" required="true" id="periode">
                        <small class="text-muted">pilih rentang waktu </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="laporanSayaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="laporanModal">Lihat Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action={{ url('pegawai/laporan') }} method="GET">
                    @csrf
                    <input type="text" name="id" class="form-control" id="id" hidden="true">                    
                    <div class="form-group">
                        <label for="email" class="control-label">Periode:</label><br>
                        Dari
                        <input type="date" name="from" class="form" required="true" id="periode">
                        Sampai <input type="date" name="to" class="form" required="true" id="periode">
                        <small class="text-muted">pilih rentang waktu </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminPckModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="laporanModal">Pilih Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action={{ route('admin_penilaian_capaian_kinerja') }} method="GET">
                    @csrf                    
                    <div class="form-group">
                        <label for="email" class="control-label">Pegawai:</label><br>
                        <select name="user_id" id="pck_user_id" class="form-control">
                            <option></option>
                        </select>
                        <small class="text-muted">silahkan untuk memilih pegawai </small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Bulan:</label><br>
                        <select name="bulan" id="rekup_bulan" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februai</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <small class="text-muted">silahkan untuk memilih bulan yang ingin ditampilkan </small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Tahun:</label><br>
                        <select name="tahun" id="rekup_tahun" class="form-control">
                            <?php 
                                $currentYear =  \Carbon\Carbon::now()->year ;
                                $oldYear = $currentYear - 10;
                                ?>
                            @for($s=$currentYear; $s >= $oldYear; $s--)
                                <option value={{$s}}>{{$s}}</option>
                            @endfor
                        </select>
                        <small class="text-muted">silahkan untuk memilih tahun yang ingin ditampilkan </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pegawaiPckModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="laporanModal">Pilih Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action={{ route('pegawai_penilaian_capaian_kinerja') }} method="GET">
                    @csrf                                        
                    <div class="form-group">
                        <label for="email" class="control-label">Bulan:</label><br>
                        <select name="bulan" id="rekup_bulan" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februai</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <small class="text-muted">silahkan untuk memilih bulan yang ingin ditampilkan </small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Tahun:</label><br>
                        <select name="tahun" id="rekup_tahun" class="form-control">
                            <?php 
                                $currentYear =  \Carbon\Carbon::now()->year ;
                                $oldYear = $currentYear - 10;
                                ?>
                            @for($s=$currentYear; $s >= $oldYear; $s--)
                                <option value={{$s}}>{{$s}}</option>
                            @endfor
                        </select>
                        <small class="text-muted">silahkan untuk memilih tahun yang ingin ditampilkan </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="adminRekapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="laporanModal">Pilih Waktu:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action={{ route('admin_rekup') }} method="GET">
                    @csrf                    
                    <div class="form-group">
                        <label for="email" class="control-label">Bulan:</label><br>
                        <select name="bulan" id="rekup_bulan" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februai</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <small class="text-muted">silahkan untuk memilih bulan yang ingin ditampilkan </small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Tahun:</label><br>
                        <select name="tahun" id="rekup_tahun" class="form-control">
                            <?php 
                                $currentYear =  \Carbon\Carbon::now()->year ;
                                $oldYear = $currentYear - 10;
                                ?>
                            @for($s=$currentYear; $s >= $oldYear; $s--)
                                <option value={{$s}}>{{$s}}</option>
                            @endfor
                        </select>
                        <small class="text-muted">silahkan untuk memilih tahun yang ingin ditampilkan </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pegawaiRekapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="laporanModal">Pilih Waktu:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action={{ route('pegawai_rekup') }} method="GET">
                    @csrf                    
                    <div class="form-group">
                        <label for="email" class="control-label">Bulan:</label><br>
                        <select name="bulan" id="rekup_bulan" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februai</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <small class="text-muted">silahkan untuk memilih bulan yang ingin ditampilkan </small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Tahun:</label><br>
                        <select name="tahun" id="rekup_tahun" class="form-control">
                            <?php 
                                $currentYear =  \Carbon\Carbon::now()->year ;
                                $oldYear = $currentYear - 10;
                                ?>
                            @for($s=$currentYear; $s >= $oldYear; $s--)
                                <option value={{$s}}>{{$s}}</option>
                            @endfor
                        </select>
                        <small class="text-muted">silahkan untuk memilih tahun yang ingin ditampilkan </small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/pegawai') }}?is_api=1",
            success: function(data) {
                for (i = 0; i < data.pegawai.length; i++) {
                    $('#pegawai_id').append(
                        `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                    );
                    $('#pck_user_id').append(
                        `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                    );
                }                
            }
        });

    });

</script>
