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
              <li class="breadcrumb-item active"><a href="<?= base_url('mahasiswa/pengajuanSurat')?>"><?= $page?></a></li>
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
                  <th scope="col">Kode Surat</th>
                  <th scope="col">Nama Surat</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $i=0; foreach ($surat as $sur) :  $i++;?>
               <tr>
                <th scope="row"><?= $i ;?></th>
                <td><?= $sur->kd_surat; ?></td>
                <td><?= $sur->nm_surat; ?></td>
                <td class="text-center">
                  <a class="btn btn-primary btn-sm" type="button" href="<?= base_url('permintaan/permintaanDetail/'.$this->encrypt->encode($sur->kd_surat).'/'.$this->encrypt->encode($sur->id_surat).'/'.$this->encrypt->encode('pengajuan'));?>">Pilih Surat</a>
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
