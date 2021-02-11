    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Admin</small></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sSuratSelesai')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('selesai/selesaiDetail/'.$this->encrypt->encode($onesls->id_konfirmasi).'/'.$this->encrypt->encode($onesls->kd_surat))?>"><small><?= $page ;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->         
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Default box -->
        <div class="card card-outline card-info">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>

          </div>
          <div class="card-body">

            <form action="" method="post">

              <div class="row">
                <div class="col-md-6">

                  <!-- No Surat And Button Generate -->
                  <div class="form-group">
                    <label for="no_surat" class="col-form-label">No Surat</label>

                    <input name="no_surat" id="no_surat" type="text" class="form-control" value="<?= $onesls->no_surat?>" readonly>

                    <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / No Surat And Button Generate -->

                  <!-- Tanda Tangan -->
                  <div class="form-group">
                    <label for="spkpTTD" class="col-form-label">Tanda Tangan</label>
                    <?php
                    // $dosenalll = "SELECT * FROM esurat_dosen";
                    if($onedos->id == $onesls->ttd) : ?>
                      <input name="ttd" id="no_surat" type="text" class="form-control" value="<?= $onedos->nama?>" readonly>
                      <?php else : ?>
                        <input name="ttd" id="no_surat" type="text" class="form-control" value="Unknown" readonly>
                      <?php endif;?>
                      <?= form_error('ttd', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Tanda Tangan -->

                    <!-- Kode Surat -->
                    <div class="form-group">
                      <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                      <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onesls->kd_surat?>" readonly>
                      <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Kode Surat -->

                  </div>

                  <div  class="col-md-6">

                    <!-- Hasil Enkripsi -->
                    <div class="form-group">
                      <label for="spkpHasilEnkripsi" class="col-form-label">Hasil Enkripsi</label>

                      <textarea type="text" class="form-control" id="spkpHasilEnkripsi" placeholder="Hasil Enkripsi" readonly><?= $onesls->enkripsi?></textarea>


                    </div>
                    <!-- / Hasil Enkripsi -->

                    <!-- QR COde -->
                    <div class="form-group">
                      <label for="qrcode" class="col-form-label">QR Code</label>
                      <div class="input-group">

                        <img id="qrcode" src="<?= base_url('assets/esurat/img/QRCode/'.str_replace("/", "_",$onesls->no_surat).'.png')?>" alt="QRCode" width="150"/>

                      </div>
                    </div>
                    <!-- / QR COde -->

                  </div>

                </div>

                <!-- Row -->
                <div class="row">
                  <!-- col-md-6 -->
                  <div class="col-md-6">

                    <!-- Nama Surat -->
                    <div class="form-group">
                      <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                      <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onesls->nm_surat?>" readonly>
                      <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Nama Surat -->

                    <!-- Kepada Yth. Surat Di Ajukan -->
                    <div class="form-group">
                      <label for="spkpKepadaYth" class="col-form-label">Kepada Yth.</label>
                      <textarea type="text" rows="1" name="kepadaYth" class="form-control" id="spkpKepadaYth" placeholder="Kepada Yth." readonly><?= $onesls->kepadaYth ;?></textarea>
                      <?= form_error('kepadaYth', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Kepada Yth. Surat Di Ajukan -->
                    <!-- Kepada Yth. Surat Di Ajukan -->
                    <div class="form-group">
                      <label for="spkpKepadaAlamat" class="col-form-label">Kepada Alamat</label>
                      <textarea type="text" rows="1" name="kepadaAlamat" class="form-control" id="spkpKepadaAlamat" placeholder="Kepada Alamat" readonly><?= $onesls->kepadaAlamat ;?></textarea>
                      <?= form_error('kepadaAlamat', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Kepada Yth. Surat Di Ajukan -->

                    <!-- Keperluan Surat Di Ajukan -->
                    <div class="form-group">
                      <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                      <textarea type="text" rows="5" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Agar diperkenankan kegiatan Kerja Praktek/Magang Kurang Lebih Selama 2 Minggu (14 Hari) dan diberikannya Bimbingan serta meminta data mengenai Profil desa, data kependudukan, dan data opsional yang memungkinkan dalam pelaksanaan Kerja Praktek. " readonly><?= $onesls->keperluan ;?></textarea>
                      <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Keperluan Surat Di Ajukan -->

                    <!-- Dosen -->
                    <div class="form-group">
                      <label for="spkpDosen" class="col-form-label">Penaggung Jawab</label>
                      <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Penaggung Jawab" value="<?= $onedos->nama ;?>" readonly>
                      <?= form_error('dosen', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Dosen -->

                  </div>
                  <!-- / col-md-6 -->

                  <!-- col-md-6 -->
                  <div class="col-md-6">

                    <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                      <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onesls->permintaan_by?>" readonly>
                      <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                    <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                      <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs;?>" readonly>
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Nama Mahasiswa YAng Mengajukan Surat -->

                    <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpNamaProdi" class="col-form-label">Prodi</label>
                      <input type="text" name="prodi" class="form-control" id="spkpNamaProdi" placeholder="Prodi" value="<?= $onepro->prodi?>" readonly>
                      <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                    <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpSemester" class="col-form-label">Semester</label>
                      <input type="text" name="semester" class="form-control" id="spkpSemester" placeholder="Semester" value="<?= semester($onemhs->thaka)?>" readonly>
                      <?= form_error('semester', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                  </div>
                  <!-- / col-md-6 -->

                </div>
                <!-- / Row -->         

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-outline collapsed-card card-info">
              <div class="card-header">
                <h4 class="card-title " text-align="center"><strong>Surat Yang Di Minta</strong></h4>
                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">

                <!-- Hasil Surat -->
                <div class="form-group row">

                  <label class="col-md-2 col-form-label"><?= $page ?></label>
                  <div class="col-md-12">
                    <textarea  class="form-control" id="spdTAHasilSurat" placeholder="Header Surat" rows="10" disabled="true"> 
                      <?= $this->parser->parse_string($isi, $komponen, TRUE);
                      ?>
                    </textarea>
                  </div>

                </div>
                <!-- / Hasil Surat -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-outline card-info">
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sSuratSelesai');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <a class="btn btn-primary btn-sm float-right text-white" href="<?= base_url('Prints/printSurat/'.$this->encrypt->encode($onesls->id_konfirmasi).'/'.$this->encrypt->encode($onesls->kd_surat))?>" target="_blank">Print &ensp;<i class="fas fa-print" target="_blank"></i></a>
            </div> 
            </div>
            <!-- /.card -->   

          </form>

        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <script type="text/javascript">
        window.onload = function () {
          CKEDITOR.replace( 'spdTAHasilSurat', {
           filebrowserImageBrowseUrl : baseURL+'assets/kcfinder-2.51/browse.php?type=images',
           filebrowserFlashBrowseUrl : baseURL+'assets/kcfinder-2.51/browse.php?type=flash',
           filebrowserUploadUrl : baseURL+'assets/kcfinder-2.51/upload.php?type=files',
           filebrowserImageUploadUrl : baseURL+'assets/kcfinder-2.51/upload.php?type=images',
           filebrowserFlashUploadUrl:  baseURL+'assets/kcfinder-2.51/upload.php?type=flash',
           contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
           height: '800'  
         } );
        }
      </script>