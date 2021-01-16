<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline">Alexander Pierce</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

          <p>
            Alexander Pierce - Web Developer
            <small>Member since Nov. 2012</small>
          </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="#" class="btn btn-default">Profile</a>
          <a href="#" data-toggle="modal" data-target="#logOutModal" data-backdrop="static" data-keyboard="true" class="btn btn-danger float-right">Log out</a>
        </li>
      </ul>
    </li>
  </ul>
</nav>