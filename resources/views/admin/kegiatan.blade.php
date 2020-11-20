@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <button id="add_kegiatan_id" type="button"
                                class="btn purple-gradient bg-gradient-primary btn-flat add_kegiatan" data-toggle="modal"
                                data-target="#tambahKegiatan">
                                <ion-icon name="add-circle-sharp"></ion-icon>
                            </button>
                        </div>
                        <div class="float-right">
                            <p>
                                <button class="btn-sm btn purple-gradient" type="button" data-toggle="collapse"
                                    data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                    <i class="fas fa-filter"></i>
                                    Filter
                                </button>
                            </p>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="container collapse" id="collapseFilter">
                                <div class="row">
                                    <div class="col-sm">
                                        <form>
                                            <label for="pegawai_id">Pegawai</label>
                                            <select id="pegawai_id" class="form-control">
                                                <option></option>
                                            </select>
                                            dari <input id="from_id" type="date" class="form-control">
                                            sampai <input id="to_id" type="date" class="form-control">
                                        </form>
                                        <a href="" id="filter_id" title="Filter">
                                            <ion-icon name="funnel"></ion-icon> Filter
                                        </a>                                        
                                    </div>
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
                                    <th>Tanggal</th>
                                    <th>Ditugaskan</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $kegiatan->kegiatan }}</td>
                                        <td>{{ $kegiatan->periode }}</td>
                                        <td>{{ $kegiatan->pegawai->nama }}</td>
                                        </td>
                                        <td>
                                            {{-- <div class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton"> --}}
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <a href="#editModal" data-toggle="modal" data-id="{{ $kegiatan->id }}"
                                                    title="Edit Data">
                                                    <ion-icon name="create-outline"></ion-icon> Edit
                                                </a><br>
                                                <a onclick="return tanya()"
                                                    href={{ url("kegiatan/delete?id=$kegiatan->id") }}>
                                                    <ion-icon name="trash-outline"></ion-icon> Hapus
                                                </a><br>
                                                <a href={{ url("kegiatan/uraian?id=$kegiatan->id") }}>
                                                    <ion-icon name="eye"></ion-icon> Uraian
                                                </a>
                                                {{--
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator Kerja</th>
                                    <th>Tanggal</th>
                                    <th>Ditugaskan</th>
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
                            <label for="mutu_target" class="control-label">Ditugaskan Kepada:</label>
                            <select name="pegawai" class="form-control" required="true" , id="ditugaskan">
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
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('/pegawai') }}?is_api=1",
                success: function(data) {
                    for (i = 0; i < data.pegawai.length; i++) {
                        $('#pegawai_id').append(
                            `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                        );
                    }
                    console.log(data);
                }
            });

            $('#filter_id').on('click', function() {
                var selectedOfficer = $('#pegawai_id').children("option:selected").val();
                var from = $('#from_id').val();
                var to = $('#to_id').val();
                var filterUrl = "{{ url('kegiatan?pegawai_id=') }}" + selectedOfficer + "&from=" + from +
                    "&to=" + to;
                $('#filter_id').attr('href', filterUrl);
            });
        })

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
                        $("#ditugaskan_id option[value=" + data.pegawai.id +
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endSection
