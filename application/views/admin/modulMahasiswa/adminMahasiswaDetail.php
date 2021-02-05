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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dMahasiswaDetail/'. $this->encrypt->encode($onemhs->nim))?>"><small><?= $page ?></small></a></li>
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
          <form class="form-horizontal">
            <div class="card-body ml-3 mr-3">

              <div class="form-group row">
                <label for="detailMhsNim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsNim" placeholder="NIM" value="<?= $onemhs->nim ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsNm" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsNm" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsProdi" class="col-sm-2 col-form-label">Prodi</label>
                <div class="col-sm-10">
                  <?php 
                  $pro = $this->db->get_where('esurat_prodi',['kdpro' => $onemhs->kdpro ])->row();
                  if($pro->kdpro == $onemhs->kdpro){
                    echo '<input type="text" class="form-control" id="detailMhsProdi" placeholder="Prodi" value="'.$pro->prodi.'" disabled>';
                  }else{
                    echo '<input type="text" class="form-control" id="detailMhsProdi" placeholder="Prodi" value="Prodi Tidak Terdaftar" disabled>';
                  }
                  ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsThAka" class="col-sm-2 col-form-label">Tahun Angkatan</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="detailMhsThAka" class="form-control" value="<?= $onemhs->thaka?>" data-inputmask='"mask": "9999/9999"' Placeholder="2013/2014" data-mask disabled>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <?php if($onemhs->kel == NULL) {
                      echo '<input type="text" class="form-control" id="detailMhsStatus" placeholder="Status" value="Other" disabled>';
                    }elseif ($onemhs->kel == 'Laki-Laki' || $onemhs->kel == 'Laki-laki' || $onemhs->kel == 'laki-Laki' || $onemhs->kel == 'laki-laki') {
                      echo '<input type="text" class="form-control" id="detailMhsStatus" placeholder="Status" value="Laki-Laki" disabled>';
                    }elseif ($onemhs->kel == 'Perempuan') {
                      echo '<input type="text" class="form-control" id="detailMhsStatus" placeholder="Status" value="Perempuan" disabled>';
                    };?>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsStatus" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsStatus" placeholder="Status" value="<?= $onemhs->status ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsAlsan_sta" class="col-sm-2 col-form-label">Alasan Status</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsAlsan_sta" placeholder="Alasan Status" value="<?= $onemhs->alasan_status ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsTpt/TglLhr" class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control mb-2" id="detailMhsTpt/TglLhr" placeholder="Tempat" value="<?= $onemhs->tptlhr ;?>" disabled>
                </div>
                <div class="col-sm-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="tglLhr" value="<?= date_indo(date('Y-m-d', strtotime(str_replace('-','/', $onemhs->tgllhr)))) ;?>" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsAlamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsAlamat" placeholder="Alamat" value="<?= $onemhs->alamat ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsNmOrtu" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsNmOrtu" placeholder="Alamat" value="<?= $onemhs->nmortu ;?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" id="detailMhsEmail" class="form-control" placeholder="someone@someone.com / someone@someone.co.id" value="<?= $onemhs->email?>" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsTelp" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="detailMhsTelp" class="form-control" value="<?= $onemhs->telp?>" data-inputmask='"mask": "9999-9999-99999"' placeholder="9999-9999-99999" data-mask disabled>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="form-group row">
                <label for="detailMhsKelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detailMhsKelas" placeholder="Kelas" value="<?= $onemhs->kelas ;?>" disabled>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/dMahasiswa');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back 
              </a>
              <a class="btn btn-warning float-right btn-sm" href="<?= base_url('admin/dMahasiswaEdit/'). $this->encrypt->encode($onemhs->nim).'';?>">
                <i class="fas fa-edit"></i>&ensp;Edit 
              </a>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->

    </section>
    <!-- /.content -->