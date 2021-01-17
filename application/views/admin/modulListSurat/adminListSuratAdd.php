  <div class="content-wrapper">
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSurat')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSuratAdd')?>"><small><?= $page ?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if($this->session->flashdata('message') == TRUE) : ?>
          <!-- Row Note -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-info bg-danger" role="alert">
                <h5><i class="fas fa-info"></i> Note:</h5>
                <?= $this->session->flashdata('message'); ?>
              </div>
            </div>
            <!--/. Col -->
          </div>
        <?php endif ;?>             
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
          <form action="<?= base_url('admin/sListSuratAdd');?>" method="post">
            <div class="card-body">

              <div class="form-group">
                <label for="addSuratKdSurat" class="col-sm-2 col-form-label">Kode Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="kodeSurat" class="form-control" id="addSuratKdSurat" placeholder="Kode Surat" value="<?= set_value('kodeSurat');?>">
                  <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="addSuratNmSurat" class="col-sm-2 col-form-label">Nama Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="namaSurat" class="form-control" id="addSuratNmSurat" placeholder="Nama Surat" value="<?= set_value('namaSurat');?>">
                  <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="addSuratKopSurat" class="col-sm-2 col-form-label">Kops Surat</label>
                <div class="col-sm-12">
                  <textarea name="kopSurat" class="form-control ckeditor" id="editor2" placeholder="Kops Surat">
                    <?= set_value('kopSurat')?>
                  </textarea>
                  <?= form_error('kopSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="addSuratHeaderSurat" class="col-sm-2 col-form-label">Header Surat</label>
                <div class="col-sm-12">
                  <textarea name="headerSurat" class="form-control ckeditor" id="addSuratHeaderSurat" placeholder="Seluruh Surat"> <?= set_value('headerSurat')?>
                </textarea>
                <?= form_error('headerSurat', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group">
              <label for="addSuratIsiSurat" class="col-sm-2 col-form-label">Isi Surat</label>
              <div class="col-sm-12">
                <textarea name="isiSurat" class="form-control ckeditor" id="addSuratIsiSurat" placeholder="Seluruh Surat">
                  <?= set_value('isiSurat')?>
                </textarea>
                <?= form_error('isiSurat', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group">
              <label for="addSuratFooterSurat" class="col-sm-2 col-form-label">Footer Surat</label>
              <div class="col-sm-12">
                <textarea name="footerSurat" class="form-control ckeditor" id="addSuratFooterSurat" placeholder="Seluruh Surat">
                  <?= set_value('footerSurat')?>
                </textarea>
                <?= form_error('footerSurat', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="radio" value="1" id="addSuratRadioAdministrator" name="access" checked>
                    <label for="addSuratRadioAdministrator">Administrator Only</label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="radio" value="2" id="addSuratRadioAdminMahasiswa" name="access" checked>
                    <label for="addSuratRadioAdminMahasiswa">Admin And Mahasiswa</label>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer justify-content-between">
            <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sListSurat');?>">
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
</div>