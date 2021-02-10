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

        <div class="row">


          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-envelope mr-1"></i>
                  Data surat yang tersedia
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body table-responsive">

                <div class="input-group ">
                  <input class="form-control col-sm-12" name="seachExample" id="seachExample" type="text" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>

                <table id="example" class="table table-bordered table-striped display nowrap" style="width:100%">
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
            <!-- /.card-body-->
            <div class="card-footer text-center">
              <a href="<?= base_url('mahasiswa/pengajuanSurat')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>
          <!-- /.card -->
        </section>
        <!-- right col -->
        <section class="col-lg-12 connectedSortable">

          <!-- Map card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-envelope mr-1"></i>
                Status surat yang telah diajukan
              </h3>
              <!-- card tools -->
              <div class="card-tools">
                <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <div class="card-body table-responsive">

              <div class="input-group ">
                <input class="form-control col-sm-12" name="seachExample1" id="seachExample1" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>

              <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
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
          <!-- /.card-body-->
          <div class="card-footer text-center">
            <a href="<?= base_url('mahasiswa/statusSurat')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- /.card -->
      </section>

    </div>
    <!-- /.Row -->     
  </div>
  <!-- /.container-fluid -->
</section>
    <!-- /.content -->