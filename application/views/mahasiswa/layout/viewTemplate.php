<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/daterangepicker/daterangepicker.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include "viewHeader.php"?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include "viewSideBar.php"?>
    <!-- /.Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <?= $contents; ?>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include "viewFooter.php" ; ?>
    <!-- /.Footer -->

    <!-- Modal -->
    <?php include "viewModal.php" ; ?>
    <!-- /.Modal -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/js/demo.js"></script>

  <!-- Costum JS -->
  <?php include "viewJs.php" ; ?>
  <!-- Costum JS -->

</body>
</html>
