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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dProdi')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dProdiAdd')?>"><small><?= $page ?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->            
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $page; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dProdiAdd')?>" method="post">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row <?php if(form_error('kdpro')) {echo 'text-danger';}?>">
                <label for="addProdiKode" class="col-sm-2 col-form-label">Kode Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kdpro" class="form-control <?php if(form_error('kdpro')) {echo 'is-invalid';}?>" id="addProdiKode" placeholder="Kode Prodi" value="<?= set_value('kdpro');?>">
                  <?php echo form_error('kdpro', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('nmpro')) {echo 'text-danger';}?>">
                <label for="addProdiNama" class="col-sm-2 col-form-label">Nama Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="nmpro" class="form-control <?php if(form_error('kdpro')) {echo 'is-invalid';}?>" id="addProdiNama" placeholder="Nama Prodi" value="<?= set_value('nmpro')?>">
                  <?php echo form_error('nmpro', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('jenpro')) {echo 'text-danger';}?>">
                <label for="addProdiJenjang" class="col-sm-2 col-form-label">Jenjang Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="jenpro" class="form-control <?php if(form_error('kdpro')) {echo 'is-invalid';}?>" id="addProdiJenjang" placeholder="Jenjang Prodi" value="<?= set_value('jenpro')?>">
                  <?php echo form_error('jenpro', '<small class="text-danger pl-3">', '</small>');?> 
                </div>
              </div>
              <div class="form-group row <?php if(form_error('kapro')) {echo 'text-danger';}?>">
                <label for="addProdiKaprodi" class="col-sm-2 col-form-label">Nama Kaprodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kapro" class="form-control <?php if(form_error('kdpro')) {echo 'is-invalid';}?>" id="addProdiKaprodi" placeholder="Nama Kaprodi" value="<?= set_value('kapro')?>">
                  <?php echo form_error('kapro', '<small class="text-danger pl-3">', '</small>');?> 
                </div>
              </div>
              <div class="form-group row <?php if(form_error('kdmkpro')) {echo 'text-danger';}?>">
                <label for="addProdikdmk" class="col-sm-2 col-form-label">Kode MK Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kdmkpro" class="form-control <?php if(form_error('kdpro')) {echo 'is-invalid';}?>" id="addProdikdmk" placeholder="Kode MK Prodi" value="<?= set_value('kdmkpro')?>">
                  <?php echo form_error('kdmkpro', '<small class="text-danger pl-3">', '</small>');?> 
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dProdi');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->