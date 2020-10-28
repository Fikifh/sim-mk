<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href={{url('/')}} class="nav-link">Website Kepegawaian MK</a>
      </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      
          <a href={{ route('logout')}} class="nav-link" >
            <ion-icon name="log-out"></ion-icon>Keluar
          </a>
      
  </ul>
</nav>
<script>
  function logout(){
      window.location = {{ route('logout')}}
      console.log('aya ki');
  }
</script>
<!-- /.navbar -->
