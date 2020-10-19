
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src= {{ asset("bower_components/AdminLTE-3.0.5/plugins/jquery/jquery.min.js") }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- AdminLTE App -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/dist/js/adminlte.min.js") }}></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- ion icons -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<!-- jQuery -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/jquery/jquery.min.js") }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- DataTables -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js") }}></script>
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}></script>
<script src={{ asset("bower_components/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}></script>
<!-- AdminLTE App -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/dist/js/adminlte.min.js") }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ asset("bower_components/AdminLTE-3.0.5/dist/js/demo.js") }}></script>
<!-- sweet alert -->
<script src= {{ asset("bower_components/AdminLTE-3.0.5/plugins/sweetalert2/sweetalert2.min.js") }}></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
