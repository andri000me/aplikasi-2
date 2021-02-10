  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $page ;?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

          <?php if($name == 'permohonan') : ?>

            <!---------------------------------------------------------------------------------------->
            <!---------------------- Code Di bawah Untuk Admin Mengajukan Surat ---------------------->
            <!---------------------------------------------------------------------------------------->

            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Admin</small></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sPermintaanSurat')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('permohonan'))?>"><small><?= $page ;?></small></a></li>
            </ol>

            <?php elseif($name == 'pengajuan') : ?>

              <!---------------------------------------------------------------------------------------->
              <!-------------------- Code Di bawah Untuk mahasiswa Mengajukan Surat -------------------->
              <!---------------------------------------------------------------------------------------->

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><small>Mahasiswa</small></li>
                <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/pengajuanSurat')?>"><small><?= $parent ;?></small></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('pengajuan'))?>"><small><?= $page ;?></small></a></li>
              </ol>

              <?php elseif($name == 'permintaan') :?>

                <!---------------------------------------------------------------------------------------->
                <!---- Code Di bawah Untuk Konfirmasi Permintaan Surat Yang telah di Ajukan Mahasiswa ---->
                <!---------------------------------------------------------------------------------------->


                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><small>Admin</small></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/sPermintaanSurat')?>"><small><?= $parent ;?></small></a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_permintaan).'/'.$this->encrypt->encode('permintaan'))?>"><small><?= $page ;?></small></a></li>
                </ol>

              <?php endif ;?>

            </div><!-- /.col -->
          </div><!-- /.row -->           
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


      <?php if($name == 'permohonan') : ?>

        <!---------------------------------------------------------------------------------------->
        <!---------------------- Code Di bawah Untuk Admin Mengajukan Surat ---------------------->
        <!---------------------------------------------------------------------------------------->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

            <form action="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('permohonan'));?>" method="post">
              <!-- Default box -->
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
                </div>
                <div class="card-body">

                  <input type="hidden" readonly name="p" class="form-control" id="spkpCosP">
                  <input type="hidden" readonly name="q" class="form-control" id="spkpCosQ">
                  <input type="hidden" readonly name="n" class="form-control" id="spkpCosN">
                  <input type="hidden" readonly name="e" class="form-control" id="spkpCosE">
                  <input type="hidden" readonly name="d" class="form-control" id="spkpCosD">

                  <div class="row">

                    <div class="col-md-6">


                      <!-- No Surat And Button Generate -->
                      <div class="form-group <?php if(form_error('no_surat')) {echo 'text-danger';}?>">
                        <label for="spkpCosNo_surat" class="col-form-label">No Surat</label>
                        <div class="input-group">
                          <input name="no_surat" id="spkpCosNo_surat" type="text" class="form-control <?php if(form_error('no_surat')) {echo 'is-invalid';}?>" readonly>
                          <span class="input-group-append">
                            <button type="button" class="btn <?php if(form_error('no_surat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" id="generateCos"><i class="fa fa-check text-white"></i>&ensp;Generate</button>
                          </span>
                        </div>
                        <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / No Surat And Button Generate -->

                      <!-- Dosen -->
                      <div class="form-group <?php if(form_error('penanggungJawab')) {echo 'text-danger';}?>">
                        <label for="spkpCosDosen" class="col-form-label">Penanggung Jawab</label>
                        <select name="penanggungJawab" id="spkpCosDosen" class="form-control select2 <?php if(form_error('penanggungJawab')) {echo 'select2-danger';}?>" <?php if(form_error('penanggungJawab')) {echo 'data-dropdown-css-class="select2-danger"';}?>  style="width: 100%;" >
                          <option value="" selected>Pilih Penanggung Jawab</option>
                          <?php
                          foreach ($dosenall as $dosen) {
                            echo '<option value="'.$dosen->id.'">'.$dosen->nama.'</option>';
                          }
                          ;?>
                        </select>
                        <?= form_error('penanggungJawab', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Dosen -->

                      <!-- Tanda Tangan -->
                      <div class="form-group <?php if(form_error('ttd')) {echo 'text-danger';}?>">
                        <label for="spkpCosTTD" class="col-form-label">Tanda Tangan</label>
                        <select name="ttd" id="spkpCosTTD" class="form-control select2 <?php if(form_error('ttd')) {echo 'select2-danger';}?>" <?php if(form_error('ttd')) {echo 'data-dropdown-css-class="select2-danger"';}?>  style="width: 100%;" >
                          <option value="" selected>Pilih Tanda Tangan</option>
                          <?php
                          foreach ($dosenall as $dosen) {
                            echo '<option value="'.$dosen->id.'">'.$dosen->nama.'</option>';
                          }
                          ;?>
                        </select>
                        <?= form_error('ttd', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Tanda Tangan -->

                    </div>

                    <div class="col-md-6">

                      <!-- Hasil Enkripsi -->
                      <div class="form-group <?php if(form_error('no_surat')) {echo 'text-danger';}?>">
                        <label for="spkpCosHasilEnkripsi" class="col-form-label">Hasil Enkripsi</label>
                        <textarea type="text" name="enkripsi" class="form-control <?php if(form_error('no_surat')) {echo 'is-invalid';}?>" id="spkpCosHasilEnkripsi" placeholder="Hasil Enkripsi" readonly></textarea>
                        <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Hasil Enkripsi -->

                      <!-- QR COde -->
                      <div class="form-group <?php if(form_error('no_surat')) {echo 'text-danger';}?>">
                        <label for="qrcode" class="col-form-label">QR Code</label>
                        <div class="input-group">
                          <img id="qrcodeCos" src="<?= base_url('assets/esurat/img/qrcode_sample.png')?>" alt="QRCode" width="150" />
                        </div>
                        <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / QR COde -->

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-6">

                      <!-- Kepada Yth. Surat Di Ajukan -->
                      <div class="form-group <?php if(form_error('kepadaYth')) {echo 'text-danger';}?>">
                        <label for="spkpKepadaYth" class="col-form-label">Kepada Yth.</label>
                        <textarea type="text" rows="1" name="kepadaYth" class="form-control <?php if(form_error('kepadaYth')) {echo 'is-invalid';}?>" id="spkpKepadaYth" placeholder="Kepada Yth."><?= set_value('kepadaYth');?></textarea>
                        <?= form_error('kepadaYth', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Kepada Yth. Surat Di Ajukan -->
                      <!-- Kepada Yth. Surat Di Ajukan -->
                      <div class="form-group <?php if(form_error('kepadaAlamat')) {echo 'text-danger';}?>">
                        <label for="spkpKepadaAlamat" class="col-form-label">Kepada Alamat</label>
                        <textarea type="text" rows="1" name="kepadaAlamat" class="form-control <?php if(form_error('kepadaAlamat')) {echo 'is-invalid';}?>" id="spkpKepadaAlamat" placeholder="Kepada Alamat"><?= set_value('kepadaAlamat');?></textarea>
                        <?= form_error('kepadaAlamat', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Kepada Yth. Surat Di Ajukan -->

                      <!-- Keperluan Surat Di Ajukan -->
                      <div class="form-group <?php if(form_error('keperluan')) {echo 'text-danger';}?>">
                        <label for="spkpCosKeperluan" class="col-form-label">Keperluan</label>
                        <textarea type="text" rows="5" name="keperluan" class="form-control <?php if(form_error('keperluan')) {echo 'is-invalid';}?>" id="spkpCosKeperluan" placeholder="Agar diperkenankan mengadakan penelitian dan meminta data mengenai data sondir" ><?= set_value('keperluan')?></textarea>
                        <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Keperluan Surat Di Ajukan -->

                      <!-- Kode Surat -->
                      <div class="form-group">
                        <label for="spkpCosKodeSurat" class="col-form-label">Kode Surat</label>
                        <input type="text" name="kodeSurat" class="form-control" id="spkpCosKodeSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat?>" readonly>
                        <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Kode Surat -->

                      <!-- Nama Surat -->
                      <div class="form-group">
                        <label for="spkpCosNamaSurat" class="col-form-label">Nama Surat</label>
                        <input type="text" name="namaSurat" class="form-control" id="spkpCosNamaSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat?>" readonly>
                        <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Nama Surat -->

                    </div>

                    <div class="col-md-6">

                      <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                      <div class="form-group <?php if(form_error('cosnim')) {echo 'text-danger';}?>">
                        <label for="spkpCosNIM" class="col-form-label">NIM Mahasiswa</label>
                        <select name="cosnim" id="spkpCosNIM" class="form-control select2 <?php if(form_error('cosnim')) {echo 'select2-danger';}?>" <?php if(form_error('cosnim')) {echo 'data-dropdown-css-class="select2-danger"';}?> style="width: 100%;" >
                          <option value="" selected>Tulis Nim mahasiswa / Nama Mahasiswa </option>
                          <?php
                          foreach ($mahasiswaall as $mhsa) {
                            echo '<option value="'.$mhsa->nim.'">'.$mhsa->nim.' / '.$mhsa->nmmhs.'</option>';
                          }
                          ;?>
                        </select>
                        <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                      <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                      <div class="form-group <?php if(form_error('cosnim')) {echo 'text-danger';}?>">
                        <label for="spkpCosNama" class="col-form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control <?php if(form_error('cosnim')) {echo 'is-invalid';}?>" id="spkpCosNama" placeholder="Nama Mahasiswa" readonly>
                        <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Nama Mahasiswa YAng Mengajukan Surat -->

                      <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                      <div class="form-group <?php if(form_error('cosnim')) {echo 'text-danger';}?>">
                        <label for="spkpCosProdi" class="col-form-label">Prodi</label>
                        <input type="text" class="form-control <?php if(form_error('cosnim')) {echo 'is-invalid';}?>" id="spkpCosProdi" placeholder="Prodi" readonly>
                        <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                      <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                      <div class="form-group <?php if(form_error('cosnim')) {echo 'text-danger';}?>">
                        <label for="spkpCosSemester" class="col-form-label">Semester</label>
                        <input type="text" class="form-control <?php if(form_error('cosnim')) {echo 'is-invalid';}?>" id="spkpCosSemester" placeholder="Semester" readonly>
                        <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                    </div>

                  </div>

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
                      <textarea name="semua" class="form-control" id="suratPermohonan" readonly> 
                        <?= $onesur->kop_surat ;?>
                        <?= $onesur->header_surat ;?>
                        <?= $onesur->isi_surat ;?>
                        <?= $onesur->footer_surat ;?>
                      </textarea>
                    </div>

                  </div>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <div class="card card-outline card-info">
                <div class="card-footer justify-content-between">
                  <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sPermintaanSurat');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                  <button type="submit" class="btn btn-primary btn-sm float-right">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
                </div>  

              </div>
              <!-- /.card -->

            </form>

          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- / Main content -->

        <script type="text/javascript">

          window.onload = function () {

            CKEDITOR.replace( 'suratPermohonan', {
             filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
             filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
             filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
             filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
             contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
             height: '800'  
           } );

            $( "#generateCos" ).click(function() {
              var kd_suratCos = $('#spkpCosKodeSurat').val();
              Swal.fire({
                title: 'Loading...',
                html: 'Please wait Generating No Surat, Enkripsi and Convert',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                  Swal.showLoading()
                  $.ajax({
                    url : baseURL+'permintaan/getNoSuratCos',
                    method :'post',
                    data : {kd_suratCos:kd_suratCos},
                    success:function(data){
                      $('#spkpCosNo_surat').val(data);
                      var no_suratCos = data;

                      $.ajax({
                        url : baseURL+'permintaan/getEnkripsiCos',
                        method : 'post',
                        data : 'no_suratCos=' +no_suratCos,
                        dataType : 'json',
                        success : function(data){
                          $('#spkpCosP').val(data.pCos);
                          $('#spkpCosQ').val(data.qCos);
                          $('#spkpCosN').val(data.nCos);
                          $('#spkpCosE').val(data.eCos);
                          $('#spkpCosD').val(data.dCos);
                          $('#spkpCosHasilEnkripsi').val(data.enkripsiCos);
                          var urlCos = baseURL;
                          var enkripsiCos = data.enkripsiCos;

                          $.ajax({
                            url : baseURL+'permintaan/getconvertCos',
                            method:"post",
                            data:'domainCos='+urlCos+'&enkripsiCos=' +enkripsiCos+'&no_suratCos='+no_suratCos,
                            success:function(data){
                              Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Generate No Surat, Enkripsi dan Convert'
                              })
                              var namafile = "<?php echo base_url('assets/esurat/img/QRCode/') ?>" + data.replace("/", "_")+".png";
                              $("#qrcodeCos").attr("src",namafile);
                            },
                            error:function(data){

                              Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Convert QR Code Error!',
                              })
                            }
                          });
                        },
                        error:function(data){
                          Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Enkripsi No Surat Error!'
                          })
                        }
                      });
                    },
                    error:function(data){
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Generate No Surat Error!'
                      })
                    }
                  });
                }
              })
            });
            /*-- / Ajax Generate No Surat, Enkripsi And Convert Costum Surat  --*/

            /*-- Ajax Memilih Nim dan Nama Mahasiswa  --*/
            $('#spkpCosNIM').change(function(){
              var nimCos = $('#spkpCosNIM').val();
              if(nimCos != ''){
                $.ajax({
                  url:baseURL+'permintaan/fetchNIMWithNama',
                  method:'POST',
                  dataType : 'json',
                  data:{nimCos:nimCos},
                  success:function(data){
                    $('#spkpCosNama').val(data.nama);
                    $('#spkpCosProdi').val(data.prodi);
                    $('#spkpCosSemester').val(data.semester);
                  }
                });
              }
            });
          }
        </script>

        <?php elseif($name == 'pengajuan') : ?>

          <!---------------------------------------------------------------------------------------->
          <!-------------------- Code Di bawah Untuk mahasiswa Mengajukan Surat -------------------->
          <!---------------------------------------------------------------------------------------->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- Default box -->
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
                </div>
                <div class="card-body">
                  <form action="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('pengajuan'));?>" method="post">
                    <div class="row">
                      <!-- col-md-6 -->
                      <div class="col-md-6">

                        <!-- Kode Surat -->
                        <div class="form-group">
                          <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                          <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat?>" readonly>
                          <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kode Surat -->

                        <!-- Nama Surat -->
                        <div class="form-group">
                          <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                          <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat?>" readonly>
                          <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Nama Surat -->

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group <?php if(form_error('kepadaYth')) {echo 'text-danger';}?>">
                          <label for="spkpKepadaYth" class="col-form-label">Kepada Yth.</label>
                          <textarea type="text" rows="1" name="kepadaYth" class="form-control <?php if(form_error('kepadaYth')) {echo 'is-invalid';}?>" id="spkpKepadaYth" placeholder="Kepada Yth."><?= set_value('kepadaYth');?></textarea>
                          <?= form_error('kepadaYth', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->
                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group <?php if(form_error('kepadaAlamat')) {echo 'text-danger';}?>">
                          <label for="spkpKepadaAlamat" class="col-form-label">Kepada Alamat</label>
                          <textarea type="text" rows="1" name="kepadaAlamat" class="form-control <?php if(form_error('kepadaAlamat')) {echo 'is-invalid';}?>" id="spkpKepadaAlamat" placeholder="Kepada Alamat"><?= set_value('kepadaAlamat');?></textarea>
                          <?= form_error('kepadaAlamat', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group <?php if(form_error('keperluan')) {echo 'text-danger';}?>">
                          <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                          <textarea type="text" rows="5" name="keperluan" class="form-control <?php if(form_error('keperluan')) {echo 'is-invalid';}?>" id="spkpKeperluan" placeholder="terkait kegiatan-kegiatan yg dilakukan oleh DPUPR."><?= set_value('keperluan');?></textarea>
                          <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Dosen -->
                        <div class="form-group <?php if(form_error('penanggungJawab')) {echo 'text-danger';}?>">
                          <label for="spkpDosen" class="col-form-label">Penanggung Jawab</label>
                          <select name="penanggungJawab" id="spkpDosen" class="form-control select2 <?php if(form_error('penanggungJawab')) {echo 'select2-danger';}?>" <?php if(form_error('penanggungJawab')) {echo 'data-dropdown-css-class="select2-danger"';}?> style="width: 100%;" >
                            <option value="" selected>Pilih Penanggung Jawab</option>
                            <?php
                            foreach ($dosenall as $dosen) {
                              echo '<option value="'.$dosen->id.'">'.$dosen->nama.'</option>';
                            }
                            ;?>
                          </select>
                          <?= form_error('penanggungJawab', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Dosen -->

                      </div>
                      <!-- / col-md-6 -->

                      <!-- col-md-6 -->
                      <div class="col-md-6">

                        <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                          <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $user->nim?>" readonly>
                          <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                        <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                          <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $user->nim?>" readonly>
                          <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Nama Mahasiswa YAng Mengajukan Surat -->

                        <!-- Kode Prodi -->
                        <div class="form-group">
                          <input type="hidden" name="kdpro" class="form-control" id="spkpKodeProdi" placeholder="Kode Prodi" value="<?= $user->kdpro;?>" readonly>
                          <?= form_error('kdpro', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kode Prodi -->

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
                          <input type="text" name="semester" class="form-control" id="spkpSemester" placeholder="Semester" value="<?= semester($user->thaka)?>" readonly>
                          <?= form_error('semester', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                      </div>
                      <!-- / col-md-6 -->

                      <!-- Semua Isi Surat -->
                      <div class="form-group col-md-12" style="display: none;">
                        <textarea  name="semua" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly >
                          <?= $onesur->kop_surat ;?>
                          <?= $onesur->header_surat ;?>
                          <?= $onesur->isi_surat ;?>
                          <?= $onesur->footer_surat ;?>
                        </textarea>
                        <?= form_error('semua', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / Semua Isi Surat -->

                    </div>
                    <hr>
                    <div class="form-group justify-content-between">
                      <a class="btn btn-secondary btn-sm" href="<?php echo base_url('mahasiswa/pengajuanSurat');?>">
                        <i class="fas fa-arrow-left"></i>&ensp;Back
                      </a>
                      <button type="submit" class="btn btn-primary btn-sm float-right">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
                    </div>             
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- / Main content -->

          <?php elseif($name == 'permintaan') :?>

            <!---------------------------------------------------------------------------------------->
            <!---- Code Di bawah Untuk Konfirmasi Permintaan Surat Yang telah di Ajukan Mahasiswa ---->
            <!---------------------------------------------------------------------------------------->

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <!-- Default box -->

                <form action="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_permintaan).'/'.$this->encrypt->encode('permintaan'));?>" method="post">

                  <div class="card card-outline card-info">
                    <div class="card-header">
                      <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
                    </div>
                    <div class="card-body">

                      <div class="row">
                        <div class="col-md-6">

                          <!-- No Surat And Button Generate -->
                          <div class="form-group <?php if(form_error('no_surat')) {echo 'text-danger';}?>">
                            <label for="no_surat" class="col-form-label">No Surat</label>
                            <div class="input-group">
                              <?php if($onepmr->id_permintaan == NULL) : ?>
                                <input name="no_surat" type="text" class="form-control <?php if(form_error('no_surat')) {echo 'is-invalid';}?>" readonly>
                                <?php else : ?>
                                  <input name="no_surat" id="no_surat" type="text" class="form-control" value="<?= $onepmr->no_surat?>" readonly>
                                <?php endif ;?>
                                <span class="input-group-append">
                                  <button type="button" class="btn <?php if(form_error('no_surat')) {echo 'btn-danger';}else{echo 'btn-info';}?>" id="generatePmr"><i class="fa fa-check text-white"></i>&ensp;Generate</button>
                                </span>
                              </div>
                              <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                            </div>
                            <!-- / No Surat And Button Generate -->

                            <!-- Tanda Tangan -->
                            <div class="form-group <?php if(form_error('ttd')) {echo 'text-danger';}?>">
                              <label for="spkpTTD" class="col-form-label">Tanda Tangan</label>
                              <select name="ttd" for="spkpTTD" class="form-control select2 <?php if(form_error('ttd')) {echo 'select2-danger';}?>" <?php if(form_error('ttd')) {echo 'data-dropdown-css-class="select2-danger"';}?> style="width: 100%;" >
                                <option value="" selected>Pilih Tanda Tangan</option>
                                <?php
                                foreach ($dosenall as $dosen) {
                                  echo '<option value="'.$dosen->id.'">'.$dosen->nama.'</option>';
                                }
                                ;?>
                              </select>
                              <?= form_error('ttd', '<small class="text-danger pl-3">', '</small>');?>
                            </div>
                            <!-- / Tanda Tangan -->

                            <!-- Kode Surat -->
                            <div class="form-group">
                              <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                              <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onepmr->kd_surat?>" readonly>
                              <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                            </div>
                            <!-- / Kode Surat -->

                          </div>

                          <div  class="col-md-6">

                            <!-- Hasil Enkripsi -->
                            <div class="form-group <?php if(form_error('no_surat')) {echo 'text-danger';}?>">
                              <label for="spkpHasilEnkripsi" class="col-form-label">Hasil Enkripsi</label>
                              <?php if($onepmr->no_surat == NULL) : ?>
                                <textarea type="text" class="form-control <?php if(form_error('no_surat')) {echo 'is-invalid';}?>" id="spkpHasilEnkripsi" placeholder="Hasil Enkripsi" readonly></textarea>
                                <?php else : ?>
                                  <textarea type="text" class="form-control" id="spkpHasilEnkripsi" placeholder="Hasil Enkripsi" readonly><?= $onepmr->enkripsi?></textarea>
                                <?php endif ;?>

                              </div>
                              <!-- / Hasil Enkripsi -->

                              <!-- QR COde -->
                              <div class="form-group <?php if(form_error('no_surat')) {echo 'text-danger';}?>">
                                <label for="qrcode" class="col-form-label">QR Code</label>
                                <div class="input-group">
                                  <?php if($onepmr->no_surat == NULL) : ?>
                                    <img id="qrcode" src="<?php if(form_error('no_surat')) {echo base_url('assets/esurat/img/qrcode_danger.png');}else{ echo base_url('assets/esurat/img/qrcode_sample.png') ;}?>" alt="QRCode" width="150" />
                                    <?php else :?>
                                      <img id="qrcode" src="<?= base_url('assets/esurat/img/QRCode/'.str_replace("/", "_",$onepmr->no_surat).'.png')?>" alt="QRCode" width="150"/>
                                    <?php endif ;?>
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
                                  <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onepmr->nm_surat?>" readonly>
                                  <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                                <!-- / Nama Surat -->

                                <!-- Kepada Yth. Surat Di Ajukan -->
                                <div class="form-group">
                                  <label for="spkpKepadaYth" class="col-form-label">Kepada Yth.</label>
                                  <textarea type="text" rows="1" name="kepadaYth" class="form-control" id="spkpKepadaYth" placeholder="Kepada Yth." readonly><?= $onepmr->kepadaYth ;?></textarea>
                                  <?= form_error('kepada', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                                <!-- / Kepada Yth. Surat Di Ajukan -->

                                <!-- Kepada Yth. Surat Di Ajukan -->
                                <div class="form-group">
                                  <label for="spkpKepadaAlamat" class="col-form-label">Kepada Alamat.</label>
                                  <textarea type="text" rows="1" name="kepadaAlamat" class="form-control" id="spkpKepadaAlamat" placeholder="Kepada Alamat" readonly><?= $onepmr->kepadaAlamat ;?></textarea>
                                  <?= form_error('kepada', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                                <!-- / Kepada Yth. Surat Di Ajukan -->

                                <!-- Keperluan Surat Di Ajukan -->
                                <div class="form-group">
                                  <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                                  <textarea type="text" rows="5" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Agar diperkenankan mengadakan penelitian dan meminta data mengenai data sondir
                                  terkait kegiatan-kegiatan yg dilakukan oleh DPUPR." readonly><?= $onepmr->keperluan ;?></textarea>
                                  <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                                <!-- / Keperluan Surat Di Ajukan -->

                                <!-- Dosen -->
                                <div class="form-group">
                                  <label for="spkpDosen" class="col-form-label">Penanggung Jawab</label>
                                  <input type="text" name="penanggungJawab" class="form-control" id="spkpDosen" placeholder="Penanggung Jawab" value="<?= $onedos->nama ;?>" readonly>
                                  <?= form_error('penanggungJawab', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                                <!-- / Dosen -->

                              </div>
                              <!-- / col-md-6 -->

                              <!-- col-md-6 -->
                              <div class="col-md-6">

                                <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                                <div class="form-group">
                                  <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                                  <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onepmr->permintaan_by?>" readonly>
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
                                <textarea  class="form-control" id="suratKonfirmasi" placeholder="Header Surat" readonly> 
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
                            <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/sPermintaanSurat');?>">
                              <i class="fas fa-arrow-left"></i>&ensp;Back
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#pengajuanDeleteModal<?= $onesur->id_permintaan;?>">
                              <i class="fas fa-trash"></i>&ensp;Tolak
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Confirm &ensp;<i class="fas fa-arrow-right"></i></button>
                          </div>
                        </div>
                        <!-- /.card -->

                      </form>

                    </div>
                    <!-- /.container-fluid -->

                    <div class="modal fade" id="pengajuanDeleteModal<?= $onesur->id_permintaan;?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header card-outline card-danger">
                            <h5 class="modal-title">Alasan Penolakan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form id="alasan_form" method="POST">
                            <div class="modal-body">
                              <div class="form-group">
                                <input type="hidden" class="form-control" id="idalasan"  readonly value="<?= $onesur->id_permintaan;?>">
                                <textarea class="form-control" id="alasan" name="alasan" placeholder="Alasan Penolakan"></textarea>
                              </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
                              <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>&ensp;Tolak</button>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                  </section>

                  <script type="text/javascript">
                    window.onload = function () {
                      CKEDITOR.replace( 'suratKonfirmasi', {
                       filebrowserBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html',
                       filebrowserImageBrowseUrl : baseURL+'assets/ckfinder/ckfinder.html?type=Images',
                       filebrowserUploadUrl : baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                       filebrowserImageUploadUrl:baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                       contentsCss : baseURL+'assets/ckeditor_4.15.1_full/mystyles.css',
                       height: '800'  
                     } );

                      $( "#generatePmr" ).click(function() {
                        var id = <?= $onesur->id_permintaan?>;
                        Swal.fire({
                          title: 'Loading...',
                          html: 'Please wait Generating No Surat, Enkripsi and Convert',
                          allowEscapeKey: false,
                          allowOutsideClick: false,
                          didOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                              url : baseURL+'permintaan/getNoSuratPmr',
                              method :'post',
                              data : {id:id},
                              success:function(data){
                                $('#no_surat').val(data);
                                var no_surat = data;
                                $.ajax({
                                  url : baseURL+'permintaan/getEnkripsiPmr',
                                  method : 'post',
                                  data : 'no_surat=' +no_surat+ '&id='+id,
                                  dataType : 'json',
                                  success : function(data){
                                    $('#spkpHasilEnkripsi').val(data.enkripsi);
                                    var url = baseURL;
                                    var enkripsi = data.enkripsi;
                                    $.ajax({
                                      url : baseURL+'permintaan/getconvertPmr',
                                      method:"post",
                                      data:'domain='+url+'&enkripsi=' +enkripsi+'&no_surat='+no_surat,
                                      success:function(data){
                                        Swal.fire({
                                          icon: 'success',
                                          title: 'Success',
                                          text: 'Generate No Surat, Enkripsi dan Convert'
                                        })
                                        var namafile = "<?php echo base_url('assets/esurat/img/QRCode/') ?>" + data.replace("/", "_")+".png";
                                        $("#qrcode").attr("src",namafile);
                                      },
                                      error:function(data){

                                        Swal.fire({
                                          icon: 'error',
                                          title: 'Oops...',
                                          text: 'Convert QR Code Error!',
                                        })
                                      }
                                    });
                                  },
                                  error:function(data){
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Oops...',
                                      text: 'Enkripsi No Surat Error!'
                                    })
                                  }
                                });
                              },
                              error:function(data){
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: 'Generate No Surat Error!'
                                })
                              }
                            });
                          }
                        })
                      });

                      $('#alasan_form').on('submit', function(event){
                        event.preventDefault();
                        var idalasan = $('#idalasan').val();
                        var alasan = $('#alasan').val();
                        $.ajax({
                          type:'POST',
                          url:baseURL+'permintaan/permintaanTolak',
                          data: {idalasan:idalasan,alasan:alasan},
                          dataType: 'json',
                          success: function(data){
                            if (data.success == true ){
                              if (data.url == true) {
                                window.location.href = data.toastr;
                                window.location.href = data.redirect;
                              }else{
                                window.location.href = data.toastr;
                                window.location.href = data.redirect;
                              }
                            }else{
                              $.each(data.messages, function(key, value){
                                var element = $('#' + key);
                                element.closest('.form-control')
                                .removeClass('is-invalid')
                                .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
                                element.closest('div.form-group').find('.text-danger')
                                .remove();
                                element.after(value);
                              });
                            }
                          }  
                        });
                      });

                    }
                  </script>

                <?php endif ;?>
