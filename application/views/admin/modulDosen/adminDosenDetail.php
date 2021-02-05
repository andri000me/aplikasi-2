    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Esurat</small></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dDosen')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dDosenDetail/'.$this->encrypt->encode($onedos->id))?>"><small><?= $page ?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->            
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title"><?php echo $page; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row">
                <label for="detailDosenNama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text"  class="form-control" id="detailDosenNama" placeholder="Nama" value="<?= $onedos->nama;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailDosenNIP" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailDosenNIP" placeholder="NIP" value="<?= $onedos->nip ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailDosenJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailDosenJabatan" placeholder="Jabatan" value="<?= $onedos->jabatan?>" disabled>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dDosen');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <a class="btn btn-warning btn-sm float-right" href="<?= base_url('admin/dDosenEdit/'.$this->encrypt->encode($onedos->id).'')?>"><i class="fas fa-user-edit"></i>&ensp;Edit</a>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->