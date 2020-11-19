@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img purple-gradient img-fluid img-circle" src={{ asset('asset/user_icon.png') }}
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $pegawai ? $pegawai->nama : null }}</h3>

                        <p class="text-muted text-center">{{ $pegawai ? $pegawai->jabatan : null }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIP</b> <a class="float-right">{{ $pegawai ? $pegawai->nip : null }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Pangkat/Gol.Ruang</b> <a
                                    class="float-right">{{ $pegawai ? $pegawai->golongan : null }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Unit Kerja</b> <a class="float-right">{{ $pegawai ? $pegawai->unit_kerja : null }}</a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        {{ $pegawai ? round($pegawai->nilai_perhitungan, 2) : null }}
                                    </h5>
                                    <span class="description-text">Perhitungan</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $pegawai ? round($pegawai->nilai_capaian, 2) : null }}
                                    </h5>
                                    <span class="description-text">Capaian</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $pegawai ? round($pegawai->kehadiran, 2) : null }}
                                    </h5>
                                    <span class="description-text">Kehadiran</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-12">
                <!-- /.card-header -->

                @foreach ($indikator_kerja as $item)
                    <div class="card">
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-tasks"></i> Indikator Kerja :</h5>
                                <b> {{ $item->kegiatan }}</b>
                            </div>
                            <!-- /.card-header -->
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kegiatan Tugas Jabatan</th>
                                                <th>AK Target</th>
                                                <th>Qty Target</th>
                                                <th>Mutu Target</th>
                                                <th>AK Realisasi</th>
                                                <th>Qty Realisasi</th>
                                                <th>Mutu Realisasi</th>
                                                <th>Perhitungan</th>
                                                <th>Nilai Perhitungan</th>
                                                <th>Nilai Capaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j = 1; ?>
                                            @foreach ($item->uraianKegiatan as $uraianKegiatan)
                                                <tr>
                                                    <td>{{ $j++ }}</td>
                                                    <td>{{ $uraianKegiatan->uraian_kegiatan }}</td>
                                                    <td>{{ $uraianKegiatan->ak_target }}</td>
                                                    <td>{{ $uraianKegiatan->qtt_target }}</td>
                                                    <td>{{ $uraianKegiatan->mutu_target }}</td>
                                                    <td>{{ $uraianKegiatan->transIndikator->ak_realisasi }}</td>
                                                    <td>{{ $uraianKegiatan->transIndikator->qtt_realisasi }}</td>
                                                    <td>{{ $uraianKegiatan->transIndikator->mutu_target }}</td>
                                                    <?php
                                                    $perhitungan = $uraianKegiatan->transIndikator->mutu_target +
                                                    $uraianKegiatan->transIndikator->mutu_realisasi;
                                                    $capaian = $perhitungan / 2;
                                                    ?>
                                                    <td>{{ round($perhitungan, 2) }}</td>
                                                    <td>{{ round($capaian, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
                                    <input type="text" name="unit_kerja" class="form-control" required="true"
                                        id="unit_kerja">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password:</label>
                                    <input type="password" name="password" class="form-control" required="true"
                                        id="password">
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
                                    <input type="text" name="golongan" class="form-control" required="true"
                                        id="golongan_id">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan" class="control-label">Jabatan:</label>
                                    <input type="text" name="jabatan" class="form-control" required="true" id="jabatan_id">
                                </div>
                                <div class="form-group">
                                    <label for="unit_kerja" class="control-label">Unit Kerja:</label>
                                    <input type="text" name="unit_kerja" class="form-control" required="true"
                                        id="unit_kerja_id">
                                </div>
                                <div class="form-group">
                                    <label for="kehadiran_id" class="control-label">Tambah Nilai Kehadiran Bulan
                                        ini:</label>
                                    <input type="number" name="kehadiran" class="form-control" id="kehadiran_id">
                                    <input type="number" hidden name="user_id" class="form-control" id="user_id">
                                    <small class="text-muted">masukan berupa angka 0 sampai 100</small>
                                </div>
                                <div class="form-group">
                                    <label for="checked_change_passwor" class="control-label">Ceklis Jika Ingin Ubah Sandi
                                        :</label>
                                    <input type="checkbox" name="checked_change_passwor" class=""
                                        id="checked_change_passwor">
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
                            url: "{{ url('admin/pegawai/id') }}?id=" + pegawai_id + "&user_id=" +
                                pegawai_id,
                            success: function(data) {
                                console.log(data)
                                $('#id_edit').val(data.pegawai.id);
                                $('#user_id').val(data.pegawai.id);
                                $('#kehadiran_id').val(data.kehadiran ? data.kehadiran.nilai :
                                    null);
                                $('#nip_id').val(data.pegawai.nip);
                                $('#nama_id').val(data.pegawai.nama);
                                $('#email_id').val(data.pegawai.email);
                                $('#golongan_id').val(data.pegawai.golongan);
                                $('#jabatan_id').val(data.pegawai.jabatan);
                                $('#unit_kerja_id').val(data.pegawai.unit_kerja);

                            }
                        });
                    });

                    $('#checked_change_passwor').change(function() {

                        if (this.checked) {
                            var returnVal = confirm("Yakin ingin mengubah sandi ?");
                            if (returnVal) {
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
