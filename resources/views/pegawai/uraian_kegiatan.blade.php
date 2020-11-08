@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Uraian Kegiatan</h3>
                        <div class="float-right">
                            <button id="add_kegiatan_id" type="button"
                                class="btn btn-block bg-gradient-primary btn-flat add_kegiatan" data-toggle="modal" 
                                data-id="{{ $kegiatan_id }}" 
                                data-target="#tambahUraianKegiatan">
                                <ion-icon name="add-circle-sharp"></ion-icon>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>{{$kegiatan_id}}</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Ak Target</th>
                                    <th>Qtt Target</th>
                                    <th>Mutu Target</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($uraian as $uraianItem)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $uraianItem->uraian_kegiatan }}</td>
                                        <td>{{ $uraianItem->ak_target }}</td>
                                        <td>{{ $uraianItem->qtt_target }}</td>
                                        <td>{{ $uraianItem->mutu_target }}</td>
                                        </td>
                                        <td>
                                            {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> --}}
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <a href="#editModal" data-toggle="modal"
                                                    data-id="{{ $uraianItem->id }}" data-kegiatanid="{{ $uraianItem->id }}" title="Edit Data">
                                                    <ion-icon name="create-outline"></ion-icon> Edit
                                                </a><br>
                                                <a onclick="return tanya()"
                                                    href={{ route('delete_pegawai_uraian_kegiatan', ['id'=>$uraianItem->id]) }}>
                                                    <ion-icon name="trash-outline"></ion-icon> Hapus
                                                </a><br>                                               
                                            {{-- </div> --}}
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Ak Target</th>
                                    <th>Qtt Target</th>
                                    <th>Mutu Target</th>
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

    <div class="modal fade" id="tambahUraianKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambahkan Uraian Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('pegawai_add_uraian_kegiatan') }} method="POST">
                        @csrf
                        <input type="number" hidden name="id" class="form-control" required="true" id="id_indikator_kerjas">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Uraian Kegiatan:</label>
                            <textarea type="text" name="uraian_kegiatan" class="form-control" required="true" id="uraian_kegiatan_add"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">AK Target:</label>
                            <input type="number" name="ak_target" class="form-control" required="true" id="ak_target_add">
                        </div>                        
                        <div class="form-group">
                            <label for="qtt_target" class="control-label">Qtt Target:</label>
                            <input type="number" name="qtt_target" class="form-control" required="true" id="qtt_target_add">
                        </div>
                        <div class="form-group">
                            <label for="mutu_target" class="control-label">Mutu Target:</label>
                            <input type="number" name="mutu_target" class="form-control" required="true" id="mutu_target_add">
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
                    <form action={{ route('pegawai_edit_uraian_kegiatan') }} method="POST">
                        @csrf
                        <input type="text" name="id" class="form-control" id="id_edit" hidden="true">                        
                        <input type="text" name="id_indikator_kerjas" class="form-control" id="id_edit" hidden="true">                        
                        <div class="form-group">
                            <label for="uraian" class="control-label">Uraian Kegiatan:</label>
                            <textarea type="text" name="uraian_kegiatan" class="form-control" required="true" id="uraian"></textarea>
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
            $('#tambahUraianKegiatan').on('show.bs.modal', function(e){
                var id_indikator_kerjas = $(e.relatedTarget).data('id');
                $('#id_indikator_kerjas').val(id_indikator_kerjas);                
            });

            $('#editModal').on('show.bs.modal', function(e) {
                var uraian_id = $(e.relatedTarget).data('id');                                  
                $.ajax({
                    type: 'GET',
                    url: "{{ url('pegawai/uraian_kegiatan_by_id') }}?id=" + uraian_id,
                    success: function(data) {                        
                        $('#id_edit').val(data.id);                          
                        $('textarea#uraian').val(data.uraian_kegiatan);
                        $('#ak_target').val(data.ak_target);
                        $('#qtt_target').val(data.qtt_target);
                        $('#mutu_target').val(data.mutu_target);
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endSection
