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
    					<li class="breadcrumb-item"><a href="<?= base_url('admin/sListSuratDetail/'.$this->encrypt->encode($onesur->id_surat))?>"><small><?= $onesur->nm_surat;?></small></a></li>
    				</ol>
    			</div><!-- /.col -->
    		</div><!-- /.row -->
    	</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
    	<div class="container-fluid">
    		<div class="card card-outline collapsed-card card-info">
    			<div class="card-header">
    				<h3 class="card-title">
    					<?= $onesur->nm_surat;?>
    				</h3>
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
    				<form>
    					<div class="form-group">
    						<label for="detailSuratKdSurat" class="col-sm-2 col-form-label">Kode Surat</label>
    						<div class="col-sm-12">
    							<input type="text" name="kodeSurat" class="form-control" id="detailSuratKdSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat ;?>" disabled>
    						</div>
    					</div>
    					<div class="form-group">
    						<label for="detailSuratNmSurat" class="col-sm-2 col-form-label">Nama Surat</label>
    						<div class="col-sm-12">
    							<input type="text" name="namaSurat" class="form-control" id="detailSuratNmSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat;?>" disabled>
    						</div>
    					</div>
    					<div class="form-group">
    						<label for="detailSuratKopSurat" class="col-sm-2 col-form-label">Kops Surat</label>
    						<div class="col-sm-12">
    							<textarea name="kopSurat" class="form-control" id="detailSuratKopSurat" placeholder="Kops Surat" disabled>
    								<?= $onesur->kop_surat;?>
    							</textarea>
    						</div>
    					</div>
    					<div class="form-group">
    						<label for="detailSuratHeaderSurat" class="col-sm-2 col-form-label">Header Surat</label>
    						<div class="col-sm-12">
    							<textarea name="headerSurat" class="form-control" id="detailSuratHeaderSurat" placeholder="Header Surat" disabled> <?= $onesur->header_surat ;?>
    						</textarea>
    					</div>
    				</div>
    				<div class="form-group"> 
    					<label for="detailSuratIsiSurat" class="col-sm-2 col-form-label">Isi Surat</label>
    					<div class="col-sm-12">
    						<textarea name="isiSurat" class="form-control" id="detailSuratIsiSurat" placeholder="Isi Surat" disabled>
    							<?= $onesur->isi_surat ;?>
    						</textarea>
    					</div>
    				</div>
    				<div class="form-group">
    					<label for="detailSuratFooterSurat" class="col-sm-2 col-form-label">Footer Surat</label>
    					<div class="col-sm-12">
    						<textarea name="footerSurat" class="form-control" id="detailSuratFooterSurat" placeholder="Footer Surat" disabled>
    							<?= $onesur->footer_surat ;?>
    						</textarea>
    					</div>
    				</div>
                    <div class="form-group">
                        <label for="detailSuratNmSurat" class="col-sm-2 col-form-label">Prodi Surat</label>
                        <div class="col-sm-12">
                            <?php foreach($prodi as $row) : ?>
                                <?php if($row->kdpro == $onesur->prodi_surat) : ?>
                                    <input type="text" name="namaSurat" class="form-control" id="detailSuratNmSurat" placeholder="Nama Surat" value="<?= $row->prodi;?>" disabled>
                                <?php endif;?>
                            <?php endforeach;?>

                        </div>
                    </div>

                    <?php if($onesur->access == 1) : ?>
                     <div class="form-group">
                      <div class="col-sm-12">
                       <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                         <input type="radio" value="1" id="detailSuratRadioAdministrator" checked>
                         <label for="detailSuratRadioAdministrator">Administrator Only</label>
                     </div>
                 </div>
             </div>
         </div>
         <?php elseif ($onesur->access == 2) : ?>
          <div class="form-group">
           <div class="col-sm-12">
            <div class="form-group clearfix">
             <div class="icheck-success d-inline ml-2">
              <input type="radio" value="2" id="detailSuratRadioAdminMahasiswa" checked>
              <label for="detailSuratRadioAdminMahasiswa">Admin And Mahasiswa Only</label>
          </div>
      </div>
  </div>
</div>
<?php endif ;?>

<div class="form-group justify-content-between">
  <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sListSurat');?>">
   <i class="fas fa-arrow-left"></i>&ensp;Back
</a>
<a class="btn btn-warning btn-sm float-right" href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat).'')?>"><i class="fas fa-user-edit"></i>&ensp;Edit</a>
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

<section class="content ">
 <div class="container-fluid">
  <!-- solid sales graph -->
  <div class="card card-outline card-info">
   <div class="card-header">
    <h3 class="card-title">
     <i class="fas fa-th mr-1"></i>
     Hasil Surat
 </h3>

 <div class="card-tools">
     <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
      <i class="fas fa-minus"></i>
  </button>
  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
      <i class="fas fa-times"></i>
  </button>
</div>
</div>
<div class="card-body">
    <textarea name="footerSurat" class="form-control" id="HasilSurat"  placeholder="Footer Surat" disabled>
     <?= $onesur->kop_surat ;?>
     <?= $onesur->header_surat ;?>
     <?= $onesur->isi_surat ;?>
     <?= $onesur->footer_surat ;?>
 </textarea>
</div>
<!-- /.card-body -->
<div class="card-footer justify-content-between">
    <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sListSurat');?>">
     <i class="fas fa-arrow-left"></i>&ensp;Back
 </a>
 <a class="btn btn-warning btn-sm float-right" href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat).'')?>"><i class="fas fa-user-edit"></i>&ensp;Edit</a>
</div>
<!-- /.card-footer -->
</div>
<!-- /.card -->
</div>

</section>
<!-- /.content -->

<script type="text/javascript">
 window.onload = function () {
  CKEDITOR.replace( 'detailSuratKopSurat', {
   filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
   filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
   filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
   filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
   contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
   height: '300'  
} );
  CKEDITOR.replace( 'detailSuratHeaderSurat', {
   filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
   filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
   filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
   filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
   contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
   height: '300'  
} );
  CKEDITOR.replace( 'detailSuratIsiSurat', {
   filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
   filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
   filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
   filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
   contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
   height: '600'  
} );
  CKEDITOR.replace( 'detailSuratFooterSurat', {
   filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
   filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
   filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
   filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
   contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
   height: '300'  
} );

  CKEDITOR.replace( 'HasilSurat', {
   filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
   filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
   filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
   filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
   contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
   height: '700'  
} );
};
</script>