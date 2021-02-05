    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $page?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Esurat</li>
              <li class="breadcrumb-item active"><a href="<?= base_url('mahasiswa/profile')?>"><?= $page?></a></li>
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
          <form class="form-horizontal" action="<?= base_url('mahasiswa/profileEdit/'). $this->encrypt->encode($user->nim).'';?>" method="post">
            <div class="card-body">

              <div class="form-group row ml-3 mr-3">
                <label for="editMhsNim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                  <input type="text" name="nim" class="form-control" id="editMhsNim" placeholder="NIM" value="<?= $user->nim ;?>" readonly>
                  <?php echo form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsNm" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="editMhsNm" placeholder="Nama Mahasiswa" value="<?= $user->nmmhs ;?>">
                  <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsProdi" class="col-sm-2 col-form-label">Prodi</label>
                <div class="col-sm-10">
                  <select name="prodi" class="form-control" id="editMhsProdi">
                    <?php foreach ($prodi as $pro) {
                      if($pro->kdpro == $user->kdpro){
                        echo '<option value="'.$pro->kdpro.'" selected>'.$pro->prodi.'</option>';
                      }else{
                        echo '<option value="'.$pro->kdpro.'">'.$pro->prodi.'</option>';
                      }
                    }?>
                  </select>
                  <?php echo form_error('prodi', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsThAka" class="col-sm-2 col-form-label">Tahun Angkatan</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="editMhsThAka" name="angkatan" class="form-control" value="<?= $user->thaka?>" data-inputmask='"mask": "9999/9999"' Placeholder="2013/2014" data-mask>
                  </div>
                  <?php echo form_error('angkatan', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <select class="form-control" name="kelamin" id="editMhsKelamin">
                      <?php if( $user->kel == NULL) {
                        echo '
                        <option value="Other" selected>Other</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                        ';
                      }elseif($user->kel == 'Laki-Laki' || $user->kel == 'Laki-laki' || $user->kel == 'laki-Laki' || $user->kel == 'laki-laki'){
                        echo '
                        <option value="Laki-Laki" selected>'.$user->kel.'</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Other">Other</option>
                        '; 
                      }elseif($user->kel == 'Perempuan'){
                        echo '
                        <option value="Perempuan" selected>'.$user->kel.'</option>
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
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsStatus" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <input type="text" name="status" class="form-control" id="editMhsStatus" placeholder="Status" value="<?= $user->status ;?>">
                  <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsAlsan_sta" class="col-sm-2 col-form-label">Alasan Status</label>
                <div class="col-sm-10">
                  <input type="text" name="als_status" class="form-control" id="editMhsAlsan_sta" placeholder="Alasan Status" value="<?= $user->alasan_status ;?>">
                  <?php echo form_error('als_status', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsTpt/TglLhr" class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                <div class="col-sm-3">
                  <input type="text" name="tempat" class="form-control mb-2" id="editMhsTpt/TglLhr" placeholder="Tempat" value="<?= $user->tptlhr ;?>">
                  <?php echo form_error('tempat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="col-sm-3" >
                  <div class="input-group date" data-provide="datepicker">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" name="tanggal" class="form-control float-right" id="tglLhr" value="<?= date('F d Y', strtotime($user->tgllhr)) ;?>" >
                  </div>
                  <?php echo form_error('tanggal', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsAlamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <input type="text" name="alamat" class="form-control" id="editMhsAlamat" placeholder="Alamat" value="<?= $user->alamat ;?>">
                  <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsNmOrtu" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                <div class="col-sm-10">
                  <input type="text" name="ortu" class="form-control" id="editMhsNmOrtu" placeholder="Alamat" value="<?= $user->nmortu ;?>">
                  <?php echo form_error('ortu', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" id="editMhsEmail" name="email" class="form-control" placeholder="someone@someone.com / someone@someone.co.id" value="<?= $user->email?>">
                  </div>
                  <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsTelp" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="editMhsTelp" name="tlp" class="form-control" value="<?= $user->telp?>" data-inputmask='"mask": "9999-9999-99999"' placeholder="9999-9999-99999" data-mask>
                  </div>
                  <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="editMhsKelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                  <input type="text" name="kelas" class="form-control" id="editMhsKelas" placeholder="Kelas" value="<?= $user->kelas ;?>">
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