    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

            <?php if($status == 'PENDING') : ?>

              <!----------------------------------------------------------------------------------------->
              <!------------------------- Tampilan Ketika Surat Masih "PENDING" ------------------------->
              <!----------------------------------------------------------------------------------------->

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><small>Mahasiswa</small></li>
                <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/statusSurat')?>"><small><?= $parent ;?></small></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($onestatus->status_surat).'/'.$this->encrypt->encode($onestatus->id_permintaan).'/'.$this->encrypt->encode($onestatus->kd_surat))?>"><small><?= $page ;?></small></a></li>
              </ol>

              <?php elseif($status == 'CONFIRM') : ?>

                <!----------------------------------------------------------------------------------------->
                <!------------------------- Tampilan Ketika Surat Masih "CONFIRM" ------------------------->
                <!----------------------------------------------------------------------------------------->

                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><small>Mahasiswa</small></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/statusSurat')?>"><small><?= $parent ;?></small></a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($onestatus->status_surat).'/'.$this->encrypt->encode($onestatus->id_konfirmasi).'/'.$this->encrypt->encode($onestatus->kd_surat))?>"><small><?= $page ;?></small></a></li>
                </ol>

              <?php endif ;?>

            </div><!-- /.col -->
          </div><!-- /.row -->          
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <?php if($status == 'PENDING') : ?>

        <!----------------------------------------------------------------------------------------->
        <!------------------------- Tampilan Ketika Surat Masih "PENDING" ------------------------->
        <!----------------------------------------------------------------------------------------->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

            <div class="callout callout-danger">
              <h5><i class="fas fa-bullhorn"></i> Status Surat!</h5>

              <p>Mohon Maaf Surat Yang Anda Ajukan Masih Dalam Proses Konfirmasi</p>
            </div>

            <!-- Default box -->
            <div class="card card-outline card-info">
              <div class="card-header">
                <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
              </div>
              <div class="card-body">
                <form action="#" method="post">
                  <div class="row">
                    <!-- col-md-6 -->
                    <div class="col-md-6">

                      <!-- Kode Surat -->
                      <div class="form-group">
                        <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                        <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onestatus->kd_surat?>" readonly>
                      </div>
                      <!-- / Kode Surat -->

                      <!-- Nama Surat -->
                      <div class="form-group">
                        <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                        <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onestatus->nm_surat?>" readonly>
                      </div>
                      <!-- / Nama Surat -->

                      <!-- Kepada Yth. Surat Di Ajukan -->
                      <div class="form-group">
                        <label for="spkpKepadaYth" class="col-form-label">Kepada Yth.</label>
                        <textarea type="text" rows="1" name="kepadaYth" class="form-control" id="spkpKepadaYth" placeholder="Kepada Yth." readonly><?= $onestatus->kepadaYth;?></textarea>
                      </div>
                      <!-- / Kepada Yth. Surat Di Ajukan -->

                      <!-- Alamat Surat Di Ajukan -->
                      <div class="form-group">
                        <label for="spkpKepadaAlamat" class="col-form-label">Kepada Alamat</label>
                        <textarea type="text" rows="1" name="kepadaAlamat" class="form-control" id="spkpKepadaAlamat" placeholder="Kepada Alamat" readonly><?= $onestatus->kepadaAlamat;?></textarea>
                      </div>
                      <!-- / Alamat Surat Di Ajukan -->

                      <!-- Kepada Yth. Surat Di Ajukan -->
                      <div class="form-group">
                        <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                        <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly><?= $onestatus->keperluan;?></textarea>
                      </div>
                      <!-- / Kepada Yth. Surat Di Ajukan -->

                      <!-- Dosen -->
                      <div class="form-group">
                        <label for="spkpDosen" class="col-form-label">Dosen</label>
                        <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Dosen" value="<?= $onedosen->nama?>" readonly>
                      </div>
                      <!-- / Dosen -->

                    </div>
                    <!-- / col-md-6 -->

                    <!-- col-md-6 -->
                    <div class="col-md-6">

                      <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                      <div class="form-group">
                        <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                        <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onestatus->permintaan_by?>" readonly>
                        <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                      <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                      <div class="form-group">
                        <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs?>" readonly>
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
                  <hr>
                  <div class="form-group justify-content-between">
                    <a class="btn btn-secondary btn-sm" href="<?php echo base_url('mahasiswa/statusSurat');?>">
                      <i class="fas fa-arrow-left"></i>&ensp;Back
                    </a>
                    <button type="submit" class="btn btn-default btn-sm float-right disabled">Print&ensp;<i class="fas fa-print text-danger"></i></button>
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

        <?php elseif($status == 'CONFIRM') : ?>

          <!----------------------------------------------------------------------------------------->
          <!------------------------- Tampilan Ketika Surat Masih "CONFIRM" ------------------------->
          <!----------------------------------------------------------------------------------------->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">

              <div class="callout callout-success">
                <h5><i class="fas fa-bullhorn"></i> Status Surat!</h5>

                <p>Selamat Surat Yang Anda Ajukan Telah di Konformasi</p>
              </div>

              <!-- Default box -->
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
                </div>
                <div class="card-body">
                  <form action="#" method="post">
                    <div class="row">
                      <!-- col-md-6 -->
                      <div class="col-md-6">

                        <!-- Kode Surat -->
                        <div class="form-group">
                          <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                          <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onestatus->kd_surat?>" readonly>
                        </div>
                        <!-- / Kode Surat -->

                        <!-- Nama Surat -->
                        <div class="form-group">
                          <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                          <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onestatus->nm_surat?>" readonly>
                        </div>
                        <!-- / Nama Surat -->

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpKepadaYth" class="col-form-label">Kepada Yth.</label>
                          <textarea type="text" rows="1" name="kepadaYth" class="form-control" id="spkpKepadaYth" placeholder="Kepada Yth." readonly><?= $onestatus->kepadaYth;?></textarea>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Alamat Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpKepadaAlamat" class="col-form-label">Kepada Alamat</label>
                          <textarea type="text" rows="1" name="kepadaAlamat" class="form-control" id="spkpKepadaAlamat" placeholder="Kepada Alamat" readonly><?= $onestatus->kepadaAlamat;?></textarea>
                        </div>
                        <!-- / Alamat Surat Di Ajukan -->

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                          <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly><?= $onestatus->keperluan;?></textarea>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Dosen -->
                        <div class="form-group">
                          <label for="spkpDosen" class="col-form-label">Dosen</label>
                          <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Dosen" value="<?= $onedosen->nama?>" readonly>
                        </div>
                        <!-- / Dosen -->

                      </div>
                      <!-- / col-md-6 -->

                      <!-- col-md-6 -->
                      <div class="col-md-6">

                        <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                          <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onestatus->permintaan_by?>" readonly>
                          <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                        <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                          <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs?>" readonly>
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
                    <hr>
                    <div class="form-group justify-content-between">
                      <a class="btn btn-secondary btn-sm" href="<?php echo base_url('mahasiswa/statusSurat');?>">
                        <i class="fas fa-arrow-left"></i>&ensp;Back
                      </a>
                      <a class="btn btn-default btn-sm float-right" href="<?= base_url('Prints/printSurat/'.$this->encrypt->encode($onestatus->id_konfirmasi).'/'.$this->encrypt->encode($onestatus->kd_surat))?>" target="blank">Print&ensp;<i class="fas fa-print text-primary"></i></a>
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

          <?php endif;?>