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
                                <tfoot>
                                    <tr>
                                        <th>Sasaran Kegiatan</th>
                                        <th>Indikator Kinerja</th>
                                        <th>Target Mutu</th>
                                        <th>Target Qty</th>
                                        <th>Satuan</th>
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
                                </tfoot>
                            </table>
                        </div>
                    {{-- </div> --}}
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            {{-- </div> --}}
            <!-- /.col -->
        </div>
    </div>
    <!-- en container fluid -->


    <!-- Add  Sasaran Kegiatan Modal -->
    <div class="modal fade" id="addSasaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambahkan Sasaran Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_add_sasaran') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Sasaran:</label>
                            <input type="text" name="sasaran" class="form-control" required="true" id="add_sasaran_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete Sasaran Kegiatan Modal -->
    <div class="modal fade" id="deleteSasaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_delete_sasaran') }} method="GET">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="sasaran_id" hidden="true" class="form-control" required="true"
                                id="delete_sasaran_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete indikator kinerja Modal -->
    <div class="modal fade" id="deleteIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_delete_indikator') }} method="GET">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="indikator_id" hidden="true" class="form-control" required="true"
                                id="delete_indikator_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Sasaran Kegiatan -->
    <div class="modal fade" id="editSasaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Ubah Sasaran Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_update_sasaran') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Sasaran:</label>
                            <input type="text" name="id" class="form-control" id="edit_sasaran_uid" hidden="true">
                            <input type="text" name="sasaran" class="form-control" required="true" id="edit_sasaran_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Indikator Kinerja Modal -->
    <div class="modal fade" id="addIndikatorKinerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambah Indikator Kinerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_add_indikator_kinerja') }} method="POST">
                        @csrf
                        <input type="text" name="id" class="form-control" id="id" hidden="true">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Indikator Kinerja:</label>
                            <input type="text" name="indikator_kinerja" class="form-control" required="true"
                                id="add_indikator_kinerja">
                            <input type="text" name="sasaran_id" hidden="true" class="form-control"
                                id="add_indikator_sasaran_id">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Target Mutu:</label>
                            <input type="number" name="mutu" class="form-control" required="true" id="add_mutu">
                        </div>
                        <div class="form-group">
                            <label for="uraian" class="control-label">Target Qty:</label>
                            <input type="number" name="qty" class="form-control" required="true" id="add_qty">
                        </div>
                        <div class="form-group">
                            <label for="ak_target" class="control-label">Satuan:</label>
                            <input type="text" name="satuan" class="form-control" required="true" id="add_satuan">
                        </div>
                        <div class="form-group">
                            <label for="ak_target" class="control-label">Pagu Anggaran:</label>
                            <input type="text" name="pagu_anggaran" class="form-control" required="true"
                                id="add_pagu_anggaran">
                        </div>
                        <div class="form-group">
                            <label for="periode" class="control-label">Periode:</label>
                            <input type="date" name="periode" class="form-control" required="true" id="add_periode">
                        </div>
                        <div class="form-group">
                            <label for="ditugaskan" class="control-label">Pegawai:</label>
                            <select required="true" class="form-control" name="ditugaskan" id="ditugaskan_id">
                                <option>
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Indikator Kinerja Modal -->
    <div class="modal fade" id="editIndikatorKinerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Ubah Indikator Kinerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_update_indikator_kinerja') }} method="POST">
                        @csrf
                        <input type="text" name="id" class="form-control" id="id" hidden="true">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Indikator Kinerja:</label>
                            <input type="text" name="indikator_kinerja" class="form-control" required="true"
                                id="update_indikator_kinerja">
                            <input type="text" name="update_indikator_sasaran_id" hidden="true" class="form-control"
                                id="update_indikator_sasaran_id">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Target Mutu:</label>
                            <input type="number" name="mutu" class="form-control" required="true" id="update_mutu">
                        </div>
                        <div class="form-group">
                            <label for="uraian" class="control-label">Target Qty:</label>
                            <input type="number" name="qty" class="form-control" required="true" id="update_qty">
                        </div>
                        <div class="form-group">
                            <label for="ak_target" class="control-label">Satuan:</label>
                            <input type="text" name="satuan" class="form-control" required="true" id="update_satuan">
                        </div>
                        <div class="form-group">
                            <label for="ak_target" class="control-label">Pagu Anggaran:</label>
                            <input type="text" name="pagu_anggaran" class="form-control" required="true"
                                id="update_pagu_anggaran">
                        </div>
                        <div class="form-group">
                            <label for="periode" class="control-label">Periode:</label>
                            <input type="date" name="periode" class="form-control" required="true" id="update_periode">
                        </div>
                        <div class="form-group">
                            <label for="ditugaskan" class="control-label">Pegawai:</label>
                            <select required="true" class="form-control" name="ditugaskan" id="update_ditugaskan_id">
                                <option>
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
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

            $('#filter_id').on('click', function() {
                var from = $('#from_id').val();
                var to = $('#to_id').val();
                var filterUrl = "{{ url('pegawai/kegiatan') }}?from=" + from + "&to=" + to;
                $('#filter_id').attr('href', filterUrl);
            });
        });

        $('.add_kegiatan').on('click', function(e) {

            // var rowid = $(e.relatedTarget).data('id');                
            $.ajax({
                type: 'GET',
                url: "{{ url('/pegawai') }}?is_api=1",
                success: function(data) {
                    for (i = 0; i < data.pegawai.length; i++) {
                        $('#ditugaskan').append(
                            `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                        );
                    }
                    console.log(data);
                }
            });
        });


        $(document).ready(function() {

            $('#editSasaran').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai/sasaran/byid') }}?id=" + id,
                    success: function(data) {
                        $('#edit_sasaran_id').val(data.nama);
                        $('#edit_sasaran_uid').val(data.id);
                    }
                });
            });

            $('#deleteSasaran').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_sasaran_id').val(id);
            });

            $('#deleteIndikator').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_indikator_id').val(id);
            });

            $('#addIndikatorKinerja').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#add_indikator_sasaran_id').val(id);
                console.log(id);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#ditugaskan_id').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                    }
                });
            });

            $('#editIndikatorKinerja').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#update_indikator_sasaran_id').val(id);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#update_ditugaskan_id').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ url('pegawai/indikator/byid') }}?id=" + id,
                    success: function(data) {
                        console.log(data);
                        $('#update_indikator_kinerja').val(data.nama);
                        $('#update_mutu').val(data.mutu);
                        $('#update_qty').val(data.qty);
                        $('#update_satuan').val(data.satuan);
                        $('#update_periode').val(data.periode);
                        $('#update_pagu_anggaran').val(data.pagu_anggaran);
                        $("#update_ditugaskan_id option[value=" + data.users_id +
                            "]").attr('selected',
                            'selected');
                    }
                });
            });

            $('#editModal').on('show.bs.modal', function(e) {
                var kegiatan_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#ditugaskan_id').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                        console.log(data);
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ url('kegiatan/id') }}?id=" + kegiatan_id,
                    success: function(data) {
                        console.log(data)
                        $('#id').val(data.id);
                        $('#nama_kegiatan').val(data.kegiatan);
                        $('#periode').val(data.periode);
                        $('textarea#uraian').val(data.uraian_kegiatan.uraian_kegiatan);
                        $('#ak_target').val(data.ak_target);
                        $('#qtt_target').val(data.qtt_target);
                        $('#mutu_target').val(data.mutu_target);
                        $("#ditugaskan_id option[value=" + data.user.id +
                            "]").attr('selected',
                            'selected');

                    }
                });
            });
        });




        function tanya() {
            var agree = confirm("Yakin ingin menghapus kegiatan ini ?");
            if (agree)
                return true;
            else
                return false
        }

    </script>

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
