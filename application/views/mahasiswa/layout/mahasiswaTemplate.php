<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/startbootstrap-creative/dist/');?>assets/img/favicon.ico" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/daterangepicker/daterangepicker.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/select2/css/select2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/toastr/toastr.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/sweetalert2/sweetalert2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <?php include "mahasiswaHeader.php"?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php include "mahasiswaSidebar.php"?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?= $contents; ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <?php include "mahasiswaFooter.php"?>
    </footer>

    <!-- Modal -->
    <?php include "mahasiswaModal.php" ; ?>
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
  <!-- date-range-picker -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/toastr/toastr.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables-rowreorder/js/dataTables.rowReorder.min.js"></script>
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <!-- InputMask -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/js/demo.js"></script>
  <!-- CKeditor -->
  <script src="<?= base_url('assets/ckeditor_4.15.1_full/');?>ckeditor.js"></script>
  <!-- Costum JS -->
  <?php include "mahasiswaJs.php" ; ?>
  <!-- Costum JS -->

</body>
</html>
