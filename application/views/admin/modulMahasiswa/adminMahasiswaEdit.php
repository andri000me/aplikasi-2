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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dMahasiswa')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dMahasiswaEdit/'. $this->encrypt->encode($onemhs->nim))?>"><small><?= $page ?></small></a></li>
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
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
          </div>
          <form class="form-horizontal" action="<?= base_url('admin/dMahasiswaEdit/'). $this->encrypt->encode($onemhs->nim).'';?>" method="post">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row <?php if(form_error('nim')) {echo 'text-danger';}?>">
                <label for="editMhsNim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                  <input type="text" name="nim" class="form-control" id="editMhsNim" placeholder="NIM" value="<?= $onemhs->nim ;?>" readonly>
                  <?php echo form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('nama')) {echo 'text-danger';}?>">
                <label for="editMhsNm" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control <?php if(form_error('nama')) {echo 'is-invalid';}?>" id="editMhsNm" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs ;?>">
                  <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('prodi')) {echo 'text-danger';}?>">
                <label for="editMhsProdi" class="col-sm-2 col-form-label">Prodi</label>
                <div class="col-sm-10">
                  <select name="prodi" class="form-control select2" id="editMhsProdi">
                    <?php foreach ($prodi as $pro) {
                      if($pro->kdpro == $onemhs->kdpro){
                        echo '<option value="'.$pro->kdpro.'" selected>'.$pro->prodi.'</option>';
                      }else{
                        echo '<option value="'.$pro->kdpro.'">'.$pro->prodi.'</option>';
                      }
                    }?>
                  </select>
                  <?php echo form_error('prodi', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('angkatan')) {echo 'text-danger';}?>">
                <label for="editMhsThAka" class="col-sm-2 col-form-label">Tahun Angkatan</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="editMhsThAka" name="angkatan" class="form-control <?php if(form_error('angkatan')) {echo 'is-invalid';}?>" value="<?= $onemhs->thaka?>" data-inputmask='"mask": "9999/9999"' Placeholder="2013/2014" data-mask>
                  </div>
                  <?php echo form_error('angkatan', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('kelamin')) {echo 'text-danger';}?>">
                <label for="editMhsKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <select class="form-control" name="kelamin" id="editMhsKelamin">
                      <?php if( $onemhs->kel == NULL) {
                        echo '
                        <option value="Other" selected>Other</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                        ';
                      }elseif($onemhs->kel == 'Laki-Laki' || $onemhs->kel == 'Laki-laki' || $onemhs->kel == 'laki-Laki' || $onemhs->kel == 'laki-laki'){
                        echo '
                        <option value="Laki-Laki" selected>'.$onemhs->kel.'</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Other">Other</option>
                        '; 
                      }elseif($onemhs->kel == 'Perempuan'){
                        echo '
                        <option value="Perempuan" selected>'.$onemhs->kel.'</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Other">Other</option>
                        '; 
                      }
                      ;?>
                    </select>
                  </div>
                  <?php echo form_error('kelamin', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('status')) {echo 'text-danger';}?>">
                <label for="editMhsStatus" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" id="editMhsStatus" name="status">
                    <option value="Aktif" <?= ($onemhs->status == "Aktif") ? ' selected' : '' ?>>Aktif</option>
                    <option value="Non Aktif" <?= ($onemhs->status == "Non Aktif") ? ' selected' : '' ?>>Non Aktif</option>
                    <option value="Keluar" <?= ($onemhs->status == "Keluar") ? ' selected' : '' ?>>Keluar</option>
                  </select>
                  <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('als_status')) {echo 'text-danger';}?>">
                <label for="editMhsAlsan_sta" class="col-sm-2 col-form-label">Alasan Status</label>
                <div class="col-sm-10">
                  <input type="text" name="als_status" class="form-control " id="editMhsAlsan_sta" placeholder="Alasan Status" value="<?= $onemhs->alasan_status ;?>">
                  <?php echo form_error('als_status', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('tempat')) {echo 'text-danger';}?>">
                <label for="editMhsTpt/TglLhr" class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                <div class="col-sm-3">
                  <input type="text" name="tempat" class="form-control mb-2 <?php if(form_error('tempat')) {echo 'is-invalid';}?>" id="editMhsTpt/TglLhr" placeholder="Tempat" value="<?= $onemhs->tptlhr ;?>">
                  <?php echo form_error('tempat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="col-sm-3" >
                  <div class="input-group date" data-provide="datepicker">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="tanggal" class="form-control float-right" id="tglLhr" value="<?= $onemhs->tgllhr ;?>" >
                  </div>
                  <?php echo form_error('tanggal', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('alamat')) {echo 'text-danger';}?>">
                <label for="editMhsAlamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamat" class="form-control <?php if(form_error('alamat')) {echo 'is-invalid';}?>" id="editMhsAlamat" placeholder="Alamat"><?= $onemhs->alamat?></textarea>
                  <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('ortu')) {echo 'text-danger';}?>">
                <label for="editMhsNmOrtu" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                <div class="col-sm-10">
                  <input type="text" name="ortu" class="form-control <?php if(form_error('ortu')) {echo 'is-invalid';}?>" id="editMhsNmOrtu" placeholder="Alamat" value="<?= $onemhs->nmortu ;?>">
                  <?php echo form_error('ortu', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('email')) {echo 'text-danger';}?>">
                <label for="editMhsEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" id="editMhsEmail" name="email" class="form-control <?php if(form_error('email')) {echo 'is-invalid';}?>" placeholder="someone@someone.com / someone@someone.co.id" value="<?= $onemhs->email?>">
                  </div>
                  <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('password')) {echo 'text-danger';}?>">
                <label for="editMhsPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="text" name="password" class="form-control" id="editMhsPassword" placeholder="Password">
                  <small class="text-danger">Kosongkan Jika Tidak Ingin Mengganti Password</small>
                  <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('tlp')) {echo 'text-danger';}?>">
                <label for="editMhsTelp" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="editMhsTelp" name="tlp" class="form-control <?php if(form_error('tlp')) {echo 'is-invalid';}?>" value="<?= $onemhs->telp?>" data-inputmask='"mask": "9999-9999-99999"' placeholder="9999-9999-99999" data-mask>
                  </div>
                  <?php echo form_error('tlp', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('kelas')) {echo 'text-danger';}?>">
                <label for="editMhsKelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                  <input type="text" name="kelas" class="form-control <?php if(form_error('kelas')) {echo 'is-invalid';}?>" id="editMhsKelas" placeholder="Kelas" value="<?= $onemhs->kelas ;?>">
                  <?php echo form_error('kelas', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/dMahasiswa');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back 
              </a>
              <button type="submit" class="btn btn-warning float-right btn-sm"><i class="fas fa-edit"></i>&ensp;Update</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->

    </section>
    <!-- /.content -->