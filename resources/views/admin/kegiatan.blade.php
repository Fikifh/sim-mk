@extends('admin_template')

@section('content')
    @if(Auth::user()->role != 'admin')
      <script>window.location.href = {{route('home')}}</script>
    @endif
    <div class="container-fluid">
    <div class="row">
      <div class="col-12">            
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kegiatan</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-block bg-gradient-primary btn-flat" data-toggle="modal" data-target="#tambahKegiatan"><ion-icon name="add-circle-sharp"></ion-icon></button>                    
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>AK Target</th>
                    <th>QTT Target</th>
                    <th>Mutu Target</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($kegiatans as $kegiatan)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$kegiatan->kegiatan}}</td>
                    <td>{{$kegiatan->periode}}</td>
                    <td>{{$kegiatan->uraianKegiatan ? $kegiatan->uraianKegiatan->ak_target : null}}</td>
                    <td>{{$kegiatan->uraianKegiatan ? $kegiatan->uraianKegiatan->qtt_target : null}}</td>
                    <td>{{$kegiatan->uraianKegiatan ? $kegiatan->uraianKegiatan->mutu_target : null}}</td>
                    <td>
                        <a href= {{ url("kegiatan/delete?id=$kegiatan->id") }}><ion-icon name="create-outline"></ion-icon></a>
                        <a href= {{ url("kegiatan/delete?id=$kegiatan->id") }}><ion-icon name="trash-outline"></ion-icon></a>                        
                    </td>
                  </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>AK Target</th>
                    <th>QTT Target</th>
                    <th>Mutu Target</th>
                    <th>Action</th>
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


<!-- Modal -->

<div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tambahkan Kegiatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>
      <div class="modal-body">
        <form action = {{ route('add_kegiatan') }} method="POST">
        @csrf
          <div class="form-group">              
            <label for="recipient-name" class="control-label">Nama Kegiatan:</label>
            <input type="text" name = "nama_kegiatan" class="form-control" required="true" id="nama-kegiatan">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Periode:</label>
            <input type="date" name = "periode" class="form-control" required="true" id="perioder">
          </div>
          <div class="form-group">
            <label for="uraian" class="control-label">Uraian Kegiatan:</label>
            <textarea type="text" name = "uraian"  class="form-control" required="true" id="uraian"></textarea>
          </div>
          <div class="form-group">
            <label for="ak_target" class="control-label">AK Target:</label>
            <input type="number" name = "ak_target"  class="form-control" required="true" id="ak_target">
          </div>
          <div class="form-group">
            <label for="qtt_target" class="control-label">Qtt Target:</label>
            <input type="number" name = "qtt_target"  class="form-control" required="true" id="qtt_target">
          </div>
          <div class="form-group">
            <label for="mutu_target" class="control-label">Mutu Target:</label>
            <input type="number" name = "mutu_target" class="form-control" required="true" id="mutu_target">
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
@endSection