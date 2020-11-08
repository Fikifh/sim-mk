@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Kegiatan</h3>
                        <div class="float-right">
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- <div class="invoice p-3 mb-3"> --}}
                            <div class="card"
                                style="background-color: #AA02E8; color: white; margin-bottom:5px !important; padding:15px;">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-4 invoice-col">
                                        <div class="row" style="margin-left: 2px;">
                                            <b>
                                            </b><strong>{{ $kegiatan->kegiatan }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h4>
                                            <small class="float-right">Waktu Pelaksaan:
                                                {{ \Carbon\Carbon::parse($kegiatan->periode)->format('M/Y') }}</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->

                                </div>
                            </div>                            
                            {{-- /.card --}}                            

                            <!-- Table row -->
                            @foreach ($uraian as $item)
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h3 class="card-title">{{ $i++ }}</h3>
                                        <div class="float-right">
                                        </div>
                                    </div> --}}

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>AK Target</th>
                                                            <th>Mutu Target</th>
                                                            <th>Qtt Target</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td>{{ $item->ak_target }}</td>
                                                            <td>{{ $item->mutu_target }}</td>
                                                            <td>{{ $item->qtt_target }}</td>
                                                            <td>
                                                                @if ($item->transIndikator)
                                                                    Selesai
                                                                @else
                                                                    Belum Selesai
                                                                @endif
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- deskripsi kegiatan column -->
                                            <div class="col-6">
                                                <p class="lead">Uraian Kegiatan:</p>
                                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                    {{ $item->uraian_kegiatan }}

                                                </p><br>
                                                <p class="text-muted">Ditugaskan oleh: {{ $kegiatan->admin->nama }}</p><br>
                                                <p class="text-muted">Keterangan :
                                                    @if ($item->transIndikator)
                                                        {{ $item->transIndikator->keterangan }}
                                                    @endif
                                                </p>

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-6">
                                                <p class="lead">
                                                    Laporan
                                                    @if ($item->transIndikator)
                                                        Telah Selesai pada
                                                        {{ \Carbon\Carbon::parse($item->transIndikator->created_at)->format('d/m/Y') }}
                                                    @endif
                                                </p>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">AK Realisasi</th>
                                                                <td>
                                                                    @if ($item->transIndikator)
                                                                        {{ $item->transIndikator->ak_realisasi }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Qtt Realisasi</th>
                                                                <td>
                                                                    @if ($item->transIndikator)
                                                                        {{ $item->transIndikator->qtt_realisasi }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Mutu Realisasi:</th>
                                                                <td>
                                                                    @if ($item->transIndikator)
                                                                        {{ $item->transIndikator->mutu_realisasi }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Perhitungan</th>
                                                                <td>
                                                                    @if ($item->transIndikator)
                                                                        {{ $item->mutu_target + $item->transIndikator->mutu_realisasi }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nilai Capaian</th>
                                                                <td>
                                                                    @if ($item->transIndikator)
                                                                        {{ ($item->mutu_target + $item->transIndikator->mutu_realisasi) / 2 }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- this row will not appear when crud -->
                                                <div class="row no-print">
                                                    <div class="col-12">
                                                        @if ($item->transIndikator)
                                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                                            <a href="#editModal" data-toggle="modal"
                                                                data-id="{{ $item->transIndikator->id }}" title="Edit">
                                                                <button type="button" class="btn aqua-gradient float-right">
                                                                    <i class="far fa-edit"></i>
                                                                    Edit
                                                                </button>
                                                            </a>
                                                        @else
                                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                                            <a href="#addModal" data-toggle="modal"
                                                                data-id="{{ $item->id }}" title="Laporkan">
                                                                <button type="button"
                                                                    class="btn purple-gradient float-right">
                                                                    <i class="fas fa-upload"></i> Laporkan
                                                                </button>
                                                            </a>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                                <!-- /.row -->
                            @endforeach

                            {{--
                        </div> --}}
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- en container fluid -->


    <!-- Add Modal -->

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Laporkan Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('laporkan') }} enctype="multipart/form-data" method="POST">
                        @csrf
                        <input hidden type="number" name="id" class="form-control" required="true" id="id_uraian_add">
                        <div class="form-group">
                            <label for="ak_realisasi" class="control-label">AK Realisasi:</label>
                            <input type="number" name="ak_realisasi" class="form-control" required="true"
                                id="ak_realisasi_add">
                        </div>
                        <div class="form-group">
                            <label for="mutu_realisasi_add" class="control-label">Mutu Realisasi:</label>
                            <input type="number" name="mutu_realisasi" class="form-control" required="true"
                                id="mutu_realisasi_add">
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="control-label">Keterangan:</label>
                            <textarea type="text" name="keterangan" class="form-control" id="keterangan_add"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="qtt_realisasi_add" class="control-label">QTT Realisasi:</label>
                        </div>
                        <button id="add_file" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        <div class="form-group" id="item_file">
                            <div class="body_file">
                                <input type="file" name="reportfile[]" class="form-group dynamic_file" id="file_add">
                                <button id="add_file" class="btn btn-small btn-danger delete"><i
                                        class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Laporkan</button>
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
                    <h4 class="modal-title" id="exampleModalLabel">Edit Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('edit_laporan') }} method="POST" encrypt="multipart/form-data">
                        @csrf
                        <input type="number" name="id" class="form-control" required="true" id="id_edit">
                        <div class="form-group">
                            <label for="ak_realisasi" class="control-label">AK Realisasi:</label>
                            <input type="number" name="ak_realisasi" class="form-control" required="true"
                                id="ak_realisasi_edit">
                        </div>
                        <div class="form-group">
                            <label for="mutu_realisasi_edit" class="control-label">Mutu Realisasi:</label>
                            <input type="number" name="mutu_realisasi" class="form-control" required="true"
                                id="mutu_realisasi_edit">
                        </div>
                        <div class="form-group">
                            <label for="qtt_realisasi_edit" class="control-label">Keterangan:</label>
                            <textarea type="number" name="keterangan" class="form-control" id="keterangan_edit"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Laporan</button>
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
            $('#editModal').on('show.bs.modal', function(e) {
                var laporan_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('pegawai/laporan_by_id') }}?id=" + laporan_id,
                    success: function(data) {
                        console.log(data)
                        $('#id_edit').val(data.id);
                        $('textarea#keterangan_edit').val(data.keterangan);
                        $('#ak_realisasi_edit').val(data.ak_realisasi);
                        $('#qtt_realisasi_edit').val(data.qtt_realisasi);
                        $('#mutu_realisasi_edit').val(data.mutu_realisasi);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#addModal').on('show.bs.modal', function(e) {

                var id_uraian = $(e.relatedTarget).data('id');
                $('#id_uraian_add').val(id_uraian);
                $('#add_file').on('click', function() {
                    $('#item_file').append(
                        '<div class="body_file"><input type="file" name="reportfile[]" class="form-group dynamic_file" required="false"id="file_add"><button id="add_file" class="btn btn-small btn-danger delete"><i class="fa fa-minus"></i></button></div>'
                    );
                });

                $('form').on('click', ".delete", function() {
                    $(this).parent(".body_file").remove();
                })

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
