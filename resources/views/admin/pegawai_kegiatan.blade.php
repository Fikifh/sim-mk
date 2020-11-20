@extends('admin_template')

@section('content')   
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kegiatan</h3>
                        <div class="float-right">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-12">
                                    <span for="from_id">Dari</span>
                                    <input name="from" id="from_id" type="date" class="date" />
                                    <span for="to_id"> Ke </span>
                                    <input name="to" id="to_id" type="date" class="date" />
                                    <a href="" id="filter_id" title="Filter">
                                        {{-- <ion-icon name="funnel"></ion-icon> Filter --}}
                                        <i class="fa fa-filter"></i>
                                    </a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator Kerja</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Diinput Oleh</th>
                                    <th>Dibuat pada</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatan as $kegiatan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $kegiatan->kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($kegiatan->periode)->format('d - M - Y') }}</td>
                                        <td>{{ $kegiatan->admin->nama }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($kegiatan->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <a href="{{ url('admin/pegawai/kegiatan/detail') . '?id=' . $kegiatan->id }}"
                                                title="Lihat">
                                                Lihat <ion-icon name="eye"></ion-icon>
                                            </a>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator Kerja</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Diinput Oleh</th>
                                    <th>Dibuat pada</th>
                                    <th>Pilihan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- en container fluid -->


    <!-- Add Modal -->

    <div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambahkan Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('add_kegiatan') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nama Kegiatan:</label>
                            <input type="text" name="nama_kegiatan" class="form-control" required="true" id="nama-kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Periode:</label>
                            <input type="date" name="periode" class="form-control" required="true" id="perioder">
                        </div>
                        <div class="form-group">
                            <label for="uraian" class="control-label">Uraian Kegiatan:</label>
                            <textarea type="text" name="uraian" class="form-control" required="true" id="uraian"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ak_target" class="control-label">AK Target:</label>
                            <input type="number" name="ak_target" class="form-control" required="true" id="ak_target">
                        </div>
                        <div class="form-group">
                            <label for="qtt_target" class="control-label">Qtt Target:</label>
                            <input type="number" name="qtt_target" class="form-control" required="true" id="qtt_target">
                        </div>
                        <div class="form-group">
                            <label for="mutu_target" class="control-label">Mutu Target:</label>
                            <input type="number" name="mutu_target" class="form-control" required="true" id="mutu_target">
                        </div>
                        <div class="form-group">
                            <label for="mutu_target" class="control-label">Ditugaskan Kepada:</label>
                            <select class="form-control" required="true" , id="ditugaskan">
                                <option value=""></option>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Ubah Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('edit_kegiatan') }} method="POST">
                        @csrf
                        <input type="text" name="id" class="form-control" id="id" hidden="true">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nama Kegiatan:</label>
                            <input type="text" name="nama_kegiatan" class="form-control" required="true" id="nama_kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Periode:</label>
                            <input type="date" name="periode" class="form-control" required="true" id="periode">
                        </div>
                        <div class="form-group">
                            <label for="uraian" class="control-label">Uraian Kegiatan:</label>
                            <textarea type="text" name="uraian" class="form-control" required="true" id="uraian"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ak_target" class="control-label">AK Target:</label>
                            <input type="number" name="ak_target" class="form-control" required="true" id="ak_target">
                        </div>
                        <div class="form-group">
                            <label for="qtt_target" class="control-label">Qtt Target:</label>
                            <input type="number" name="qtt_target" class="form-control" required="true" id="qtt_target">
                        </div>
                        <div class="form-group">
                            <label for="mutu_target" class="control-label">Mutu Target:</label>
                            <input type="number" name="mutu_target" class="form-control" required="true" id="mutu_target">
                        </div>
                        <div class="form-group">
                            <label for="ditugaskan" class="control-label">Ditugaskan Kepada:</label>
                            <select required="true" class="form-control" name="ditugaskan" id="ditugaskan_id">
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
