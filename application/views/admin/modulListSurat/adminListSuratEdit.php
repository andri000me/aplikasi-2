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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat))?>"><small><?= $page ?></small></a></li>
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
    <section class="content ">
      <div class="container-fluid">
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">
              <?php echo $page; ?>&ensp;
            </h3>
            <div class="card-tools">
              <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            <form action="<?php echo base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat).'')?>" method="post">
              <div class="form-group">
                <label for="editSuratKdSurat" class="col-sm-2 col-form-label">Kode Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="kodeSurat" class="form-control <?php if(form_error('kodeSurat')) {echo 'is-invalid';}?>" id="editSuratKdSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat ;?>">
                  <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="editSuratNmSurat" class="col-sm-2 col-form-label">Nama Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="namaSurat" class="form-control <?php if(form_error('namaSurat')) {echo 'is-invalid';}?>" id="editSuratNmSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat;?>">
                  <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>

              <div class="card card-outline card-warning collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Kops Surat</h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <textarea name="kopSurat" class="form-control <?php if(form_error('kopSurat')) {echo 'is-invalid';}?>" id="suratKop" placeholder="Seluruh Surat">                     
                    <?= $onesur->kop_surat;?>
                  </textarea>
                  <?= form_error('kopSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <div class="card card-outline card-warning">
                <div class="card-header">
                  <h3 class="card-title">Header Surat</h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <textarea name="headerSurat" class="form-control <?php if(form_error('headerSurat')) {echo 'is-invalid';}?>" id="suratHeader" placeholder="Seluruh Surat"> 
                    <?= $onesur->header_surat ;?>
                  </textarea>
                  <?= form_error('headerSurat', '<small class="text-danger pl-3">', '</small>');?>

                </div>
                <!-- /.card-body -->

              </div>
              <!-- /.card -->


              <div class="card card-outline card-warning">
                <div class="card-header">
                  <h3 class="card-title">Isi Surat</h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                  <textarea name="isiSurat" class="form-control <?php if(form_error('isiSurat')) {echo 'is-invalid';}?>" id="suratIsi" placeholder="Seluruh Surat">
                    <?= $onesur->isi_surat ;?>
                  </textarea>
                  <?= form_error('isiSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <!-- /.card-body -->

              </div>
              <!-- /.card -->

              <div class="card card-outline card-warning">
                <div class="card-header">
                  <h3 class="card-title">Footer Surat</h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                  <textarea name="footerSurat" class="form-control <?php if(form_error('footerSurat')) {echo 'is-invalid';}?>" id="suratFooter" placeholder="Seluruh Surat">
                    <?= $onesur->footer_surat ;?>
                  </textarea>
                  <?= form_error('footerSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <!-- /.card-body -->

              </div>
              <!-- /.card -->


              <?php if($onesur->access == 1 ) : ?>
                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="form-group clearfix">
                      <div class="icheck-warning d-inline">
                        <input type="radio" value="1" id="EditSuratRadioAdministrator" name="access" checked>
                        <label for="EditSuratRadioAdministrator">Administrator Only</label>
                      </div>
                      <div class="icheck-success d-inline ml-2">
                        <input type="radio" value="2" id="EditSuratRadioAdminMahasiswa"  name="access">
                        <label for="EditSuratRadioAdminMahasiswa">Admin And Mahasiswa</label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php elseif($onesur->access == 2) :?>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <div class="form-group clearfix">
                        <div class="icheck-warning d-inline">
                          <input type="radio" value="1" id="EditSuratRadioAdministrator" name="access">
                          <label for="EditSuratRadioAdministrator">Administrator Only</label>
                        </div>
                        <div class="icheck-success d-inline ml-2">
                          <input type="radio" value="2" id="EditSuratRadioAdminMahasiswa"  name="access" checked>
                          <label for="EditSuratRadioAdminMahasiswa">Admin And Mahasiswa</label>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif ;?>


                <div class="form-group justify-content-between">
                  <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sListSurat');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                  <button type="submit" class="btn btn-warning btn-sm float-right"><i class="fas fa-user-edit"></i>&ensp;Update</button>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    <script type="text/javascript">
      window.onload = function () {
        CKEDITOR.replace( 'suratKop', {
         filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
         filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
         filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
         filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
         contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
         height: '300'  
       } );
        CKEDITOR.replace( 'suratHeader', {
         filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
         filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
         filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
         filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
         contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
         height: '300'  
       } );
        CKEDITOR.replace( 'suratIsi', {
         filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
         filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
         filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
         filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
         contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
         height: '600'  
       } );
        CKEDITOR.replace( 'suratFooter', {
         filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
         filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
         filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
         filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
         contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
         height: '300'  
       } );
      };
    </script>