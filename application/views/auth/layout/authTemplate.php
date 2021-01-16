<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= $title?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/startbootstrap-creative/dist/');?>assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
  <!-- Third party plugin CSS-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?= base_url('assets/startbootstrap-creative/dist/');?>css/styles.css" rel="stylesheet" />
  <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/bootstrap-sweetalert/dist/sweetalert.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/toastr/toastr.min.css">
</head>
<body id="page-top">

  <!-- Header -->
  <?php include "authHeader.php";?>
  <!-- /.Header -->

  <!-- Content Wrapper. Contains page content -->
  <?= $contents; ?>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <?php include "authFooter.php" ; ?>
  <!-- /.Footer -->

  <!-- Modal-->
  <?php include "authModal.php" ; ?>
  <!-- /.Modal-->
  
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url('assets/startbootstrap-creative/dist/');?>js/scripts.js"></script>
  <!-- SweetAlert -->
    <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url('assets/AdminLTE-3.1.0-rc/');?>plugins/toastr/toastr.min.js"></script>
  <!-- Auth JS -->
  <?php include "authJs.php" ; ?>
  <!-- /.Auth JS -->
</body>
</html>
