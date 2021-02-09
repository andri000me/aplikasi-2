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
              <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa')?>"><small><?= $page ;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->         
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-bell mr-1"></i>
              Data Surat
            </h3>
            <!-- tools card -->
            <div class="card-tools">
              <!-- button with a dropdown -->
              <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <div class="card-body">

            <div class="card card-outline card-info">
              <div class="card-header">
                <h4 class="card-title " text-align="center">Tersedia Surat</h4>
              </div>
              <div class="card-body table-responsive">

                <div>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Surat</th>
                        <th scope="col">Nama Surat</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=0; foreach ($listsuratlimit as $ls) :  $i++;?>
                      <tr>
                        <th scope="row"><?= $i ;?></th>
                        <td><?= $ls->kd_surat; ?></td>
                        <td><?= $ls->nm_surat; ?></td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.row -->
            </div>
            <div class="card-footer text-center">
              <a href="<?= base_url('mahasiswa/pengajuanSurat')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <hr>

          <div class="card card-outline card-info">
            <div class="card-header">
              <h4 class="card-title " text-align="center">Status Surat</h4>
            </div>
            <div class="card-body table-responsive">

              <div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama Surat</th>
                      <th scope="col" class="text-center">Status Surat</th>
                      <th scope="col">Tanggal Pengajuan</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($statussuratlimit as $ssl) :  $i++;?>
                    <tr>
                      <th scope="row"><?= $i ;?></th>
                      <td><?= $ssl->nm_surat; ?></td>
                      <td>
                        <?php if($ssl->status_surat == 'PENDING') {
                          echo '<div class="text-center text-white">
                          <a class="btn btn-danger btn-sm" disabled ><i class="loading-icon fa fa-spinner fa-spin"></i>&ensp;'.$ssl->status_surat.'</a>
                          </div>';
                        }else{
                          echo '<div class="text-center text-white">
                          <a class="btn btn-success btn-sm" disabled ><i class="fa fa-check"></i>&ensp;'.$ssl->status_surat.'</a>
                          </div>';
                        }?>
                      </td>
                      <td><?= date('d F Y', strtotime($ssl->permintaan_tgl)); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.row -->
          </div>
          <div class="card-footer text-center">
            <a href="<?= base_url('mahasiswa/statusSurat')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div><!-- /.container-fluid -->
</section>
    <!-- /.content -->