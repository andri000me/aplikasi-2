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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dDosenEdit/'.$this->encrypt->encode($onedos->id))?>"><small><?= $page ?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->            
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title"><?php echo $page; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dDosenEdit/'.$this->encrypt->encode($onedos->id).'')?>" method="post">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row <?php if(form_error('nama')) {echo 'text-danger';}?>">
                <label for="detailDosenNama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control <?php if(form_error('nama')) {echo 'is-invalid';}?>" id="detailDosenNama" placeholder="Nama" value="<?= $onedos->nama;?>">
                  <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('nip')) {echo 'text-danger';}?>">
                <label for="detailDosenNIP" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" name="nip" class="form-control <?php if(form_error('nip')) {echo 'is-invalid';}?>" id="detailDosenNIP" placeholder="NIP" value="<?= $onedos->nip ;?>">
                  <?php echo form_error('nip', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('jabatan')) {echo 'text-danger';}?>">
                <label for="detailDosenJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                  <input type="text" name="jabatan" class="form-control <?php if(form_error('jabatan')) {echo 'is-invalid';}?>" id="detailDosenJabatan" placeholder="Jabatan" value="<?= $onedos->jabatan?>">
                  <?php echo form_error('jabatan', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dDosen');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <button type="submit" class="btn btn-warning btn-sm float-right"><i class="fas fa-user-edit"></i>&ensp;Update</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->