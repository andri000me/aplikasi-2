    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $page?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Esurat</small></li>
              <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/statusSurat')?>"><small><?= $page ;?></small></a></li>
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
          <div class="card-body table-responsive">

            <div class="input-group ">
              <input class="form-control col-sm-12" name="seachExample" id="seachExample" type="text" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>

            <table id="example" class="table table-bordered table-striped nowrap" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">No Surat</th>
                  <th scope="col">Jenis Surat</th>
                  <th scope="col">Tanggal Pengajuan</th>
                  <th scope="col" class="text-center">Status Surat</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($allstatus as $als) :  $i++;?>
                <tr>
                  <th scope="row"><?= $i ;?></th>
                  <td>
                    <?php if($als->no_surat == NULL) {
                      echo'Unknown';
                    }else{
                      echo $als->no_surat;
                    };?>
                  </td>
                  <td><?= $als->nm_surat; ?></td>
                  <td><?= date('d F Y', strtotime($als->permintaan_tgl)); ?></td>
                  <td class="text-center">
                    <?php if($als->status_surat == 'PENDING') {
                      echo '
                      <a class="btn btn-danger btn-sm text-white" disabled ><i class="loading-icon fa fa-spinner fa-spin"></i>&ensp;'.$als->status_surat.'</a>
                      ';
                    }else{
                      echo '
                      <a class="btn btn-success btn-sm text-white" disabled ><i class="fa fa-check"></i>&ensp;'.$als->status_surat.'</a>
                      ';
                    }?>
                  </td>
                  <td class="text-center">
                    <?php if($als->status_surat == 'PENDING') : ?>
                      <a style="margin-right:10px" href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($als->status_surat).'/'.$this->encrypt->encode($als->id_konfirmasi).'/'.$this->encrypt->encode($als->kd_surat).'');?>"><i class="fas fa-info-circle text-info"></i></a>
                      <a style="margin-right:10px" target="blank" title="Print"><i class="fas fa-print text-danger btn-sm disabled"></i></a>
                      <?php else : ?>
                        <a style="margin-right:10px" href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($als->status_surat).'/'.$this->encrypt->encode($als->id_konfirmasi).'/'.$this->encrypt->encode($als->kd_surat).'');?>"><i class="fas fa-info-circle text-info"></i></a>
                        <a style="margin-right:10px" href="<?= base_url('Prints/printSurat/'.$this->encrypt->encode($als->id_konfirmasi).'/'.$this->encrypt->encode($als->kd_surat))?>" target="_blank" title="Print"><i class="fas fa-print text-primary btn-sm disabled"></i></a>
                      <?php endif;?>
                    </td>

                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->

    </section>