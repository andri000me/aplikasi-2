<!-- Masthead-->
<header class="masthead page-section" id="home">
    <div class="container h-100">
        <?php if($this->session->flashdata('message') == TRUE) : ?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif ;?> 
    <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
            <h1 class="text-uppercase text-white font-weight-bold"><?= $page ;?></h1>
            <hr class="divider my-4" />
        </div>
        <div class="col-lg-8 align-self-baseline">
            <p class="text-white-75 font-weight-light mb-5">Aplikasi Ini Dibuat Untuk Memenuhi Kebutuhan Mahasiswa Dalam Mengajukan Surat</p>

        </div>
    </div>
</div>
</header>