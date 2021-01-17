  <div class="content-wrapper">
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSurat')?>"><small><?= $page ;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if($this->session->flashdata('message') == TRUE) : ?>
          <!-- Row Note -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-info bg-danger" role="alert">
                <h5><i class="fas fa-info"></i> Note:</h5>
                <?= $this->session->flashdata('message'); ?>
              </div>
            </div>
            <!--/. Col -->
          </div>
        <?php endif ;?>             
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
            <a class="btn btn-sm btn-outline-info float-right" href="<?= base_url('admin/sListSuratAdd')?>">
              <i class="fas fa-plus"></i> Add Data
            </a>
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
                  <th scope="col">kode Surat</th>
                  <th scope="col">Nama Surat</th>
                  <th scope="col">Access Surat</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($surat as $sur) :  $i++;?>
                <tr>
                  <td><?= $i ;?></td>
                  <td><?php echo $sur->kd_surat; ?></td>
                  <td><?php echo $sur->nm_surat; ?></td>
                  <?php if($sur->access == 1) {
                    echo '<td>Administrator Only</td>';
                  }elseif($sur->access == 2){
                    echo '<td>All</td>';
                  }else{
                    echo '<td>All</td>';
                  };?>
                  <td>
                    <a style="margin-right:10px" href="<?= base_url('admin/sListSuratDetail/'.$this->encrypt->encode($sur->id_surat).'')?>" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
                    <a style="margin-right:10px" href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($sur->id_surat).'')?>" title="Edit"><i class="fas fa-edit text-warning"></i></a>
                    <a type="button" style="margin-right:10px" data-toggle="modal" data-target="#suratDeleteModal<?= $sur->id_surat;?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                    <a style="margin-right:10px" href="<?= base_url('admin/sListSuratPrint/'.$this->encrypt->encode($sur->id_surat).'')?>" target="blank" title="Edit"><i class="fas fa-print text-primary"></i></a>
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

    <!-- Barang Hapus Modal-->
    <?php $i=0; foreach($surat as $all) :  $i++;?>
    <div class="modal fade" id="suratDeleteModal<?php echo $all->id_surat;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title">Hapus <?= $page;?> "<?php echo $all->nm_surat;?>" </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Pilih "Hapus" dibawah untuk menghapus <?= $page;?> <b><?php echo $all->nm_surat;?></b>.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/sListSuratDelete/').$this->encrypt->encode($all->id_surat).'';?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <?php endforeach; ?>

</section>

</div>