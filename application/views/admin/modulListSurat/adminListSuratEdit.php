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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat))?>"><small><?= $onesur->nm_surat;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->          
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid">
        <!-- form start -->
        <form action="<?php echo base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat).'')?>" method="post">

          <div class="card card-outline <?php if(form_error('kodeSurat') || form_error('namaSurat')) {echo 'card-danger text-danger';}else{echo 'card-info';}?>">
            <div class="card-header">
              <h3 class="card-title">
                <?= $onesur->nm_surat;?>
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm <?php if(form_error('kodeSurat') || form_error('namaSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm <?php if(form_error('kodeSurat') || form_error('namaSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                <label for="editSuratKdSurat" class="col-sm-2 col-form-label <?php if(form_error('kodeSurat') == false) {echo 'text-dark';}?>">Kode Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="kodeSurat" class="form-control <?php if(form_error('kodeSurat')) {echo 'is-invalid';}?>" id="editSuratKdSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat ;?>" readonly>
                  <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="editSuratNmSurat" class="col-sm-2 col-form-label <?php if(form_error('namaSurat') == false) {echo 'text-dark';}?>">Nama Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="namaSurat" class="form-control <?php if(form_error('namaSurat')) {echo 'is-invalid';}?>" id="editSuratNmSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat;?>">
                  <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card card-outline collapsed-card <?php if(form_error('kopSurat')) {echo 'card-danger text-danger';}else{echo 'card-info';}?>">
            <div class="card-header">
              <h3 class="card-title">Kops Surat</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm <?php if(form_error('kopSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-sm <?php if(form_error('kopSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="remove">
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

          <div class="card card-outline <?php if(form_error('headerSurat')) {echo 'card-danger text-danger';}else{echo 'card-info';}?>">
            <div class="card-header">
              <h3 class="card-title">Header Surat</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm <?php if(form_error('headerSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm <?php if(form_error('headerSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="remove">
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

          <div class="card card-outline <?php if(form_error('isiSurat')) {echo 'card-danger text-danger';}else{echo 'card-info';}?>">
            <div class="card-header">
              <h3 class="card-title">Isi Surat</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm <?php if(form_error('isiSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm <?php if(form_error('isiSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="remove">
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

          <div class="card card-outline <?php if(form_error('footerSurat')) {echo 'card-danger text-danger';}else{echo 'card-info';}?>">
            <div class="card-header">
              <h3 class="card-title">Footer Surat</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm <?php if(form_error('footerSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-sm <?php if(form_error('footerSurat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" data-card-widget="remove">
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

          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">Surat Ditujukan Kepada</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group <?php if(form_error('prodiSurat')) {echo 'text-danger';}?>">
                <label for="addSuratKdSurat" class="col-sm-2 col-form-label <?php if(form_error('prodiSurat') == false) {echo 'text-dark';}?>">Prodi Surat</label>
                <div class="col-sm-12">
                  <select name="prodiSurat" id="spkpCosDosen" class="form-control select2 <?php if(form_error('prodiSurat')) {echo 'select2-danger';}?>" <?php if(form_error('prodiSurat')) {echo 'data-dropdown-css-class="select2-danger"';}?>  style="width: 100%;" >
                    <?php
                    foreach ($prodi as $row) {
                      if($row->kdpro == $onesur->prodi_surat){
                        echo '<option value="'.$row->kdpro.'" selected>'.$row->kdpro.' / '.$row->prodi.'</option>';
                      }else{
                        echo '<option value="'.$row->kdpro.'">'.$row->kdpro.' / '.$row->prodi.'</option>';
                      }
                    }
                    ;?>
                  </select>
                  <?= form_error('prodiSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
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
              </div>
              <!-- /.card-body -->
              <div class="card-footer justify-content-between">
                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sListSurat');?>">
                  <i class="fas fa-arrow-left"></i>&ensp;Back
                </a>
                <button type="submit" class="btn btn-warning btn-sm float-right"><i class="fas fa-user-edit"></i>&ensp;Update</button>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </form>
          <!-- form End -->
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