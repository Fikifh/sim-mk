@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $page_title }}</h3>
                        <div class="float-right">
                            <button id="add_kegiatan_id" type="button"
                                class="btn btn-block bg-gradient-primary btn-flat add_kegiatan" data-toggle="modal"
                                data-target="#addModal">
                                <ion-icon name="add-circle-sharp"></ion-icon>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->golongan }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->unit_kerja }}</td>
                                        <td>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <a href="#editModal" data-toggle="modal" data-id="{{ $item->id }}" title="Ubah">
                                                <ion-icon name="create-outline">Edit</ion-icon>
                                            </a>
                                            <a title="Hapus" onclick="return tanya()"
                                                href={{ url("admin/pegawai/delete?id=$item->id") }}>
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
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

    <!-- add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('add_admin_pegawai') }} method="POST">
                        @csrf
                        <input type="text" name="id" class="form-control" id="id" hidden="true">
                        <div class="form-group">
                            <label for="nip" class="control-label">NIP:</label>
                            <input type="text" name="nip" class="form-control" required="true" id="nip">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input type="email" name="email" class="form-control" required="true" id="email">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nama:</label>
                            <input type="text" name="nama" class="form-control" required="true" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="uraian" class="control-label">Golongan:</label>
                            <input type="text" name="golongan" class="form-control" required="true" id="golongan">
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="control-label">Jabatan:</label>
                            <input type="text" name="jabatan" class="form-control" required="true" id="jabatan">
                        </div>
                        <div class="form-group">
                            <label for="unit_kerja" class="control-label">Unit Kerja:</label>
                            <input type="text" name="unit_kerja" class="form-control" required="true" id="unit_kerja">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password:</label>
                            <input type="password" name="password" class="form-control" required="true" id="password">
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
                    <form action={{ route('edit_admin_pegawai') }} method="POST">
                        @csrf
                        <input type="text" name="id" class="form-control" id="id_edit" hidden="true">
                        <div class="form-group">
                            <label for="nip" class="control-label">NIP:</label>
                            <input type="text" name="nip" class="form-control" required="true" id="nip_id">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input type="email" name="email" class="form-control" required="true" id="email_id">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nama:</label>
                            <input type="text" name="nama" class="form-control" required="true" id="nama_id">
                        </div>
                        <div class="form-group">
                            <label for="uraian" class="control-label">Golongan:</label>
                            <input type="text" name="golongan" class="form-control" required="true" id="golongan_id">
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="control-label">Jabatan:</label>
                            <input type="text" name="jabatan" class="form-control" required="true" id="jabatan_id">
                        </div>
                        <div class="form-group">
                            <label for="unit_kerja" class="control-label">Unit Kerja:</label>
                            <input type="text" name="unit_kerja" class="form-control" required="true" id="unit_kerja_id">
                        </div>
                        <div class="form-group">
                            <label for="checked_change_passwor" class="control-label">Ceklis Jika Ingin Ubah Sandi :</label>
                            <input type="checkbox" name="checked_change_passwor" class="" id="checked_change_passwor">
                        </div>
                        <input type="password" name="password" hidden="true" placeholder="Change Password"
                            class="form-control" id="password_id">
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
                var pegawai_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/pegawai/id') }}?id=" + pegawai_id,
                    success: function(data) {
                        console.log(data.nama)
                        $('#id_edit').val(data.id);
                        $('#nip_id').val(data.nip);
                        $('#nama_id').val(data.nama);
                        $('#email_id').val(data.email);
                        $('#golongan_id').val(data.golongan);
                        $('#jabatan_id').val(data.jabatan);
                        $('#unit_kerja_id').val(data.unit_kerja);

                    }
                });
            });

            $('#checked_change_passwor').change(function() {

                if (this.checked) {
                    var returnVal = confirm("Yakin ingin mengubah sandi ?");
                    if(returnVal){
                        $('#password_id').attr('hidden', false); 
                        $(this).prop("checked", returnVal);    
                    } else {
                        $('#password_id').attr('hidden', true);
                        $('#password_id').val(null);
                        $(this).prop("checked", returnVal); 
                    }
                                       
                    console.log('berhasil kesini');
                } else {
                    $('#password_id').attr('hidden', true);
                }
                $('#checked_change_passwor').val(this.checked);


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
