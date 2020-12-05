@extends('admin_template')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <table class="" style="margin-bottom:10px;">
                    <?php $user = $indikator_kinerjas->first() ? $indikator_kinerjas->first()->pegawai : null; ?>
                    @if ($user)
                        <tr>
                            <td>1. </td>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <td>2. </td>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $user->nip }}</td>
                        </tr>
                        <tr>
                            <td>3. </td>
                            <td>Pangkat</td>
                            <td>:</td>
                            <td>{{ $user->pangkat }}</td>
                        </tr>
                        <tr>
                            <td>4. </td>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $user->golongan }}</td>
                        </tr>
                        <tr>
                            <td>5. </td>
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td>{{ $user->unit_kerja }}</td>
                        </tr>
                    @endif
                </table>                               
            </div>
            <div class="col-12">
                <div class="float-right">
                    <a href={{ route('admin_penilaian_capaian_kinerja', ['is_print' => true, 'user_id' => $user ? $user->id : null, 'periode' => null])}}
                        title="Print Laporan" target="_blank    ">
                        <button class="btn btn-sm purple-gradient">
                           <i class="fas fa-print"></i>
                        </button>
                    </a>                    
                </div> 
            </div>
            <div class="col-12">
                @foreach ($indikator_kinerjas as $indikator_kinerja)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-muted" style="margin-top : 10px;">Indikator Kinerja:
                                {{ $indikator_kinerja->nama }}
                            </h3>
                            <div class="float-right">
                                <a href="#addKegiatanTugasJabatan" data-toggle="modal"
                                    data-id="{{ $indikator_kinerja->id }}" title="Tambah Kegiatan Tugas Jabatan">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_sasaran" class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Kegiatan
                                                Tugas Jabatan:</th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">AK</th>
                                            <th colspan="2" style="vertical-align : middle;text-align:center;">Target</th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">AK Realisasi
                                            </th>
                                            <th colspan="2" style="vertical-align : middle;text-align:center;">Realisasi
                                            </th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Perhitungan
                                            </th>
                                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Nilai Capaian
                                            </th>
                                        <tr>
                                            <td>Qty</td>
                                            <td>Mutu</td>
                                            <td>Qty</td>
                                            <td>Mutu</td>
                                        </tr>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $perhitungan = 0;
                                        $nilaiCapaian = 0;
                                        $jumlahRow = sizeof($indikator_kinerja->kegiatanTugasJabatan) != 0 ? sizeof($indikator_kinerja->kegiatanTugasJabatan) : 1;
                                        ?>
                                        @foreach ($indikator_kinerja->kegiatanTugasJabatan as $tugasJabatan)
                                            <tr>
                                                <td>
                                                    {{ $i++ . '. ' . $tugasJabatan->uraian_kegiatan }}
                                                    <br>
                                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                    <a href="#editKegiatanTugasJabatan" data-toggle="modal"
                                                        data-id="{{ $tugasJabatan->id }}" title="Edit Sasaran Kegiatan">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#deleteKegiatanTugasJabatan" data-toggle="modal"
                                                        data-id="{{ $tugasJabatan->id }}" title="Hapus Indikator Kinerja">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $tugasJabatan->ak_target }}</td>
                                                <td>{{ $tugasJabatan->qtt_target }}</td>
                                                <td>{{ $tugasJabatan->mutu_target }}</td>
                                                <td>{{ $tugasJabatan->ak_realisasi }}</td>
                                                <td>{{ $tugasJabatan->qty_realisasi }}</td>
                                                <td>{{ $tugasJabatan->mutu_realisasi }}</td>
                                                <td>{{ $tugasJabatan->mutu_target + $tugasJabatan->mutu_realisasi }}</td>
                                                <td>{{ ($tugasJabatan->mutu_target + $tugasJabatan->mutu_realisasi) / 2 }}
                                                </td>
                                                <?php
                                                $perhitungan = $perhitungan + ($tugasJabatan->mutu_target +
                                                $tugasJabatan->mutu_realisasi);
                                                $nilaiCapaian = $nilaiCapaian + ($tugasJabatan->mutu_target +
                                                $tugasJabatan->mutu_realisasi) / 2;                                                
                                                ?>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" style="vertical-align : middle;text-align:center;">Nilai Capaian
                                            </td>
                                            <td>{{ round($perhitungan / $jumlahRow , 3)}}</td>
                                            <td>{{ round($nilaiCapaian  / $jumlahRow, 3)}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endforeach
            </div>
            <!-- /.col -->

            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title center" style="margin-top :10px;">
                            <?php 
                                $indikatorKerja = $indikator_kinerjas->first();                                
                                ?>
                            REKAPITULASI PENILAIAN CAPAIAN KINERJA REKAPITULASI PENILAIAN CAPAIAN KINERJA {{$indikatorKerja ? \Carbon\Carbon::parse($indikatorKerja->periode)->isoFormat('MMMM Y') : null}}
                            {{-- {{$indikatorKerja != null ? \Carbon\Carbon::parse($indikatorKerja->periode)->format('F Y') : null}} --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_sasaran" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Kegiatan Tugas Jabatan</th>
                                        <th>Perhitugan</th>
                                        <th>Nilai Capaian Kinerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $finalPerhitungan = 0;
                                    $finalNilaiCapaian = 0;
                                    $numOfRow = sizeof($conclusion) != 0 ? sizeof($conclusion) : 1;
                                    ?>
                                    @foreach ($conclusion as $item)
                                        <tr>
                                            <td>{{ $item->indikator_kerja }}</td>
                                            <td>{{ round($item->perhitungan == null ? $item->target : $item->perhitungan, 2) }}</td>
                                            <td>{{ round($item->nilai_capaian == null ? $item->target : $item->nilai_capaian, 2) }}</td>
                                        </tr>
                                        <?php
                                        $finalPerhitungan = $finalPerhitungan + ($item->perhitungan == null ? $item->target : $item->perhitungan);
                                        $finalNilaiCapaian = $finalNilaiCapaian + ( $item->nilai_capaian == null ? $item->target : $item->nilai_capaian);                                        
                                        ?>
                                    @endforeach
                                </tbody>                                
                                <tfoot>
                                    <tr>
                                        <td colspan="0" style="vertical-align : middle;text-align:center;">Hasil Capaian
                                            Kinerja</td>
                                        <td>{{ round($finalPerhitungan / $numOfRow, 3) }}</td>
                                        <td>{{ round($finalNilaiCapaian / $numOfRow, 3) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align : middle;text-align:center;">
                                        </td>
                                        <td>
                                            <?php $nilaiCapaian =
                                            \App\Models\NilaiCapaian::where('nilai_angka_min', '<=',
                                                round($finalNilaiCapaian / $numOfRow, 3)) ->where('nilai_angka', '>=',
                                                round($finalNilaiCapaian / $numOfRow, 3))
                                                ->first(); ?>
                                                @if ($nilaiCapaian)
                                                    {{ $nilaiCapaian->nilai_text }}
                                                @endif
                                        </td>
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


    <!-- Add  Kegiatan Tugas Jabatan Modal -->
    <div class="modal fade" id="addKegiatanTugasJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambahkan Kegiatan Tugas Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('admin_pegawai_add_tugas_jabatan') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan (*):</label>
                            <input type="text" name="uraian_kegiatan" class="form-control" required="true"
                                id="add_kegiiatan_tugas_uraian">
                            <input type="number" hidden="true" name="indikator_kerjas_id" class="form-control"
                                 id="add_kegiiatan_indikator_kerja_id">
                            <input type="number" hidden="true" name="user_id" class="form-control" 
                                id="add_kegiatan_indikator_kerja_user_id">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">AK Target(*):</label>
                            <input type="number" name="ak_target" class="form-control" required="true"
                                id="add_kegiiatan_tugas_ak_target">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Mutu Target(*):</label>
                            <input type="number" name="mutu_target" class="form-control" required="true"
                                id="add_kegiiatan_tugas_mutu_target">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Qty Target(*):</label>
                            <input type="number" name="qty_target" class="form-control" required="true"
                                id="add_kegiiatan_tugas_qty_target">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">AK Realisasi:</label>
                            <input type="number" name="ak_realisasi" class="form-control"
                                id="add_kegiiatan_tugas_ak_realisasi">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Mutu Realisasi:</label>
                            <input type="number" name="mutu_realisasi" class="form-control"
                                id="add_kegiiatan_tugas_mutu_realisasi">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Qty Realisasi:</label>
                            <input type="text" name="qty_realisasi" class="form-control"
                                id="add_kegiiatan_tugas_qty_realisasi">
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

    <!-- Edit  Kegiatan Tugas Jabatan Modal -->
    <div class="modal fade" id="editKegiatanTugasJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Ubah Kegiatan Tugas Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('admin_pegawai_update_pck') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan (*):</label>
                            <input type="text" name="uraian_kegiatan" class="form-control" required="true"
                                id="edit_kegiatan_tugas_uraian">
                            <input type="number" hidden="true" name="id" class="form-control" required="true"
                                id="edit_kegiatan_tugas_id">
                            <input type="number" hidden="true" name="user_id" class="form-control" required="true"
                                id="edit_kegiatan_tugas_user_id">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">AK Target(*):</label>
                            <input type="number" name="ak_target" class="form-control" required="true"
                                id="edit_kegiatan_tugas_ak_target">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Mutu Target(*):</label>
                            <input type="number" name="mutu_target" class="form-control" required="true"
                                id="edit_kegiatan_tugas_mutu_target">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Qty Target(*):</label>
                            <input type="number" name="qty_target" class="form-control" required="true"
                                id="edit_kegiatan_tugas_qty_target">
                            <small class="text-muted">tanda (*) adalah wajib diisi</small>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">AK Realisasi:</label>
                            <input type="number" name="ak_realisasi" class="form-control"
                                id="edit_kegiatan_tugas_ak_realisasi">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Mutu Realisasi:</label>
                            <input type="number" name="mutu_realisasi" class="form-control"
                                id="edit_kegiatan_tugas_mutu_realisasi">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Qty Realisasi:</label>
                            <input type="text" name="qty_realisasi" class="form-control"
                                id="edit_kegiatan_tugas_qty_realisasi">
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
    <div class="modal fade" id="deleteKegiatanTugasJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('admin_pegawai_delete_pck') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="id" hidden="true" class="form-control" required="true"
                                id="delete_pck_id">
                            <input type="text" name="user_id" hidden="true" class="form-control" required="true"
                                id="delete_user_id">
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

            $('#addKegiatanTugasJabatan').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#add_kegiiatan_indikator_kerja_id').val(id);
                $('#add_kegiatan_indikator_kerja_user_id').val({{$user ? $user->id : null}});
            });

            $('#editKegiatanTugasJabatan').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#edit_kegiatan_tugas_id').val(id);
                $('#edit_kegiatan_tugas_user_id').val({{$user ? $user->id : null}});
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/pegawai/pck/byid') }}?id=" + id,
                    success: function(data) {
                        $('#edit_kegiatan_tugas_uraian').val(data.uraian_kegiatan);
                        $('#edit_kegiatan_indikator_kerja_id').val(data.id_indikator_kerjas);
                        $('#edit_kegiatan_tugas_ak_target').val(data.ak_target);
                        $('#edit_kegiatan_tugas_mutu_target').val(data.mutu_target);
                        $('#edit_kegiatan_tugas_qty_target').val(data.qtt_target);
                        $('#edit_kegiatan_tugas_ak_realisasi').val(data.ak_realisasi);
                        $('#edit_kegiatan_tugas_mutu_realisasi').val(data.mutu_realisasi);
                        $('#edit_kegiatan_tugas_qty_realisasi').val(data.qty_realisasi);
                    }
                });

            });


            $('#deleteKegiatanTugasJabatan').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_pck_id').val(id);
                $('#delete_user_id').val({{$user ? $user->id : null}});
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
