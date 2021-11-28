@extends('admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <div class="clo-6">

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($envelopes as $envelope)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $envelope['name'] }}</td>
                                        <td>
                                            <button id="{{ $envelope['id'] }}" type="button"
                                                class="btn purple-gradient bg-gradient-primary btn-flat add_kegiatan"
                                                data-toggle="modal" data-target="#{{ $envelope['id'] }}_modal">
                                                <i class="fa fa-plus-cirle">Buat</i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <td>Action</td>
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


    <!-- Cuti Modal -->
    <div class="modal fade" id="id_cuti_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Buat Permohonan Cuti</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('createLeave') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id" class="control-label">Pilih Pegawai</label>
                            <select name="employee_id" class="form-control" required="true" id="employee_id">
                                <option value=""></option>
                            </select>
                            <small class="text-muted">Jika Pegawai tidak ada di list bisa menambahkan di menu
                                pegawai</small>
                        </div>
                        <div class="form-group">
                            <label for="leave_number" class="control-label">Nomor Cuti</label>
                            <input type="leave_number" name="leave_number" placeholder="W11.U22/932/KP.05.2/XI/2021"
                                class="form-control" required="true" id="leave_number">
                        </div>
                        <div class="form-group">
                            <label for="work_time" class="control-label">Waktu Kerja</label>
                            <input type="text" name="work_time" placeholder="1 Tahun 2 Bulan" class="form-control"
                                required="true" id="work_time">
                        </div>
                        <div class="form-group">
                            <label for="leave_type_id" class="control-label">Jenis Cuti</label>
                            <select name="leave_type" class="form-control" id="leave_type_id" required>
                                <option value="">pilih</option>
                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                <option value="Cuti Sakit">Cuti Sakit</option>
                                <option value="Cuti karena Alasan Penting">Cuti karena Alasan Penting</option>
                                <option value="Cuti Besar">Cuti Besar</option>
                                <option value="Cuti Cuti Melahirkan">Cuti Cuti Melahirkan</option>
                                <option value="Cuti Diluar Tanggungan Negara">Cuti Diluar Tanggungan Negara</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leave_reason" class="control-label">Alasan Cuti</label>
                            <input type="text" name="leave_reason" placeholder="Alasan Cuti" class="form-control"
                                required="true" id="leave_reason">
                        </div>
                        <div class="form-group">
                            <label for="leave_date_from" class="control-label">Dari Tanggal</label>
                            <input type="date" name="leave_date_from" class="form-control col-sm-6" required="true"
                                id="leave_date_from">
                            <label for="leave_date_from" class="control-label">Sampai Tanggal</label>
                            <input type="date" name="leave_date_to" class="form-control col-sm-6" required="true"
                                id="leave_date_to">
                        </div>
                        <div class="form-group">
                            <label for="leave_address" class="control-label">Alamat Selama Menjalan Cuti</label>
                            <input type="text" name="leave_address" placeholder="Alamat selama menjalankan cuti"
                                class="form-control" required="true" id="leave_address_id">
                        </div>
                        <div class="form-group">
                            <label for="leave_address" class="control-label">Telp</label>
                            <input type="number" name="leave_phone" placeholder="nomor hp" class="form-control"
                                required="true" id="leave_phone">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cuti Modal -->

    <!-- KPKNL Modal -->
    <div class="modal fade" id="id_kpknl_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Buat Surat Tugas KPKNL</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('createAssignmentKPKNL') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id" class="control-label">Pilih Pegawai</label>
                            <select multiple name="employee_ids[]" class="form-control" required="true"
                                id="kpknl_employee_id">
                                <option value=""></option>
                            </select>
                            <small class="text-muted">Bisa melakukan multiple select dengan menekan tombol CTRL. Jika
                                Pegawai tidak ada di list bisa menambahkan di menu
                                pegawai</small>
                        </div>
                        <div class="form-group">
                            <label for="leave_number" class="control-label">Nomor Surat</label>
                            <input type="text" name="letter_number" placeholder="W11.U22/932/KP.05.2/XI/2021"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        <div class="form-group">
                            <label for="work_time" class="control-label">Isi Surat</label>
                            <textarea name="body_letter" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL SPMT -->
    <div class="modal fade" id="id_spmt_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Buat SPMT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('createSPMT') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id" class="control-label">Yang Dinyatakan</label>
                            <select name="employee_id" class="form-control" required="true"
                                id="spmt_employee_stated">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leave_number" class="control-label">Nomor Surat</label>
                            <input type="text" name="letter_number" placeholder="W11.U22/932/KP.05.2/XI/2021"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_number" class="control-label">Nomor SK</label>
                            <input type="text" name="sk_number"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_date" class="control-label">Tanggal SK</label>
                            <input type="date" name="sk_date"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_date_start" class="control-label">Tanggal SK Dimulai</label>
                            <input type="date" name="sk_date_start"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="date_start" class="control-label">Tanggal Mulai</label>
                            <input type="date" name="date_start"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="tunjangan" class="control-label">Jumlah Tunjangan Angka</label>
                            <input type="number" name="tunjangan"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="tunjangan_dibaca" class="control-label">Jumlah Tunjangan Dalam Teks</label>
                            <input type="text" name="tunjangan_dibaca"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF MODAL SPMT --}}


    <!-- MODAL SPMJ -->
    <div class="modal fade" id="id_spmj_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Buat SPMJ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('createSPMJ') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id" class="control-label">Yang Dinyatakan</label>
                            <select name="employee_id" class="form-control" required="true"
                                id="spmj_employee_stated">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leave_number" class="control-label">Nomor Surat</label>
                            <input type="text" name="letter_number" placeholder="W11.U22/932/KP.05.2/XI/2021"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_number" class="control-label">Nomor SK</label>
                            <input type="text" name="sk_number"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_date" class="control-label">Tanggal SK</label>
                            <input type="date" name="sk_date"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_date_start" class="control-label">Tanggal SK Dimulai</label>
                            <input type="date" name="sk_date_start"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="date_start" class="control-label">Tanggal Mulai</label>
                            <input type="date" name="date_start"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="tunjangan" class="control-label">Jumlah Tunjangan Angka</label>
                            <input type="number" name="tunjangan"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="tunjangan_dibaca" class="control-label">Jumlah Tunjangan Dalam Teks</label>
                            <input type="text" name="tunjangan_dibaca"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF MODAL SPMJ --}}


    <!-- MODAL SPP -->
    <div class="modal fade" id="id_spp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Buat SPP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('createSPP') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id" class="control-label">Yang Dinyatakan</label>
                            <select name="employee_id" class="form-control" required="true"
                                id="spp_employee_stated">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leave_number" class="control-label">Nomor Surat</label>
                            <input type="text" name="letter_number" placeholder="W11.U22/932/KP.05.2/XI/2021"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_number" class="control-label">Nomor SK</label>
                            <input type="text" name="sk_number"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_date" class="control-label">Tanggal SK</label>
                            <input type="date" name="sk_date"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="sk_date_start" class="control-label">Tanggal SK Dimulai</label>
                            <input type="date" name="sk_date_start"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="date_start" class="control-label">Tanggal Mulai</label>
                            <input type="date" name="date_start"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="tunjangan" class="control-label">Jumlah Tunjangan Angka</label>
                            <input type="number" name="tunjangan"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="tunjangan_dibaca" class="control-label">Jumlah Tunjangan Dalam Teks</label>
                            <input type="text" name="tunjangan_dibaca"
                                class="form-control" required="true" id="letter_number">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF MODAL SPP --}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_spmt_modal').on('show.bs.modal', function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#spmt_employee_stated').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                    }
                });
            });

            $('#id_spmj_modal').on('show.bs.modal', function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#spmj_employee_stated').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                    }
                });
            });

            $('#id_spp_modal').on('show.bs.modal', function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#spp_employee_stated').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                    }
                });
            });

            $('#id_cuti_modal').on('show.bs.modal', function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#employee_id').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                        console.log(data);
                    }
                });
            });

            $('#id_kpknl_modal').on('show.bs.modal', function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/pegawai') }}?is_api=1",
                    success: function(data) {
                        for (i = 0; i < data.pegawai.length; i++) {
                            $('#kpknl_employee_id').append(
                                `<option value="${data.pegawai[i].id}"> ${data.pegawai[i].nama} </option>`
                            );
                        }
                        console.log(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function(e) {
                var pegawai_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/pegawai/id') }}?id=" + pegawai_id +
                        "&user_id=" +
                        pegawai_id,
                    success: function(data) {
                        console.log(data)
                        $('#id_edit').val(data.pegawai.id);
                        $('#user_id').val(data.pegawai.id);
                        $('#kehadiran_id').val(data.kehadiran ? data.kehadiran
                            .nilai : null);
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
