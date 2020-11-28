@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <button class="btn-sm btn purple-gradient" style="float : left;" type="button"
                                data-toggle="modal" data-target="#addSasaran">
                                <i class="fas fa-plus"> Sasaran</i>
                            </button>                            
                        </div>
                        <div class="float-right">
                            <form>
                                <select name="year" id="" class="form-control">
                                    <?php $firstYear = \Carbon\Carbon::now()->year - 10; ?>
                                    @for ($i = 0; $i < 19; $i++)
                                        <option>{{ $firstYear++ }}</option>
                                    @endfor
                                </select>
                                <button class="btn-sm btn purple-gradient" type="button" data-toggle="collapse"
                                    data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                    <i class="fas fa-filter"></i>
                                    Filter
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
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
                                                <br>
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <a href="#editSasaran" data-toggle="modal" data-id="{{ $sasaran->id }}"
                                                    title="Edit Sasaran Kegiatan">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#addIndikatorKinerja" data-toggle="modal"
                                                    data-id="{{ $sasaran->id }}" title="Tambah Indikator Kinerja">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <a href="#deleteSasaran" data-toggle="modal" data-id="{{ $sasaran->id }}"
                                                    title="Hapus Indikator Kinerja">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @foreach ($sasaran->indikatorKerjas as $indikatorKerja)
                                            <tr>
                                                <td>
                                                    {{ $j++ . '. ' . $indikatorKerja->nama }}
                                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                    <a href="#editIndikatorKinerja" data-toggle="modal"
                                                        data-id="{{ $indikatorKerja->id }}" title="Ubah Indikator Kinerja">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#deleteIndikator" data-toggle="modal"
                                                        data-id="{{ $indikatorKerja->id }}" title="Hapus Indikator Kinerja">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
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
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
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
@endSection
