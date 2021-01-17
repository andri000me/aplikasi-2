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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dProdi')?>"><small><?= $page ;?></small></a></li>
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
            <a class="btn btn-sm btn-outline-info float-right" href="<?= base_url('admin/dProdiAdd')?>">
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
                  <th scope="col">kode Prodi</th>
                  <th scope="col">Prodi</th>
                  <th scope="col">Kaprodi</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($prodi as $pro) :  $i++;?>
                <tr>
                  <td><?= $i ;?></td>
                  <td><?php echo $pro->kdpro; ?></td>
                  <td><?php echo $pro->prodi; ?></td>
                  <td><?php echo $pro->kaprodi; ?></td>
                  <td>
                    <a style="margin-right:10px" href="<?= base_url('admin/dProdiDetail/'.$this->encrypt->encode($pro->kdpro).'')?>" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
                    <a style="margin-right:10px" href="<?= base_url('admin/dProdiEdit/'.$this->encrypt->encode($pro->kdpro).'')?>" title="Edit"><i class="fas fa-edit text-warning"></i></a>
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#prodiDeleteModal<?= $pro->kdpro;?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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
    <?php $i=0; foreach($prodi as $all) :  $i++;?>
    <div class="modal fade" id="prodiDeleteModal<?php echo $all->kdpro;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title">Hapus <?= $page;?> "<?php echo $all->prodi;?>" </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Pilih "Hapus" dibawah untuk menghapus <?= $page;?> <b><?php echo $all->prodi;?></b>.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/dProdiDelete/').$this->encrypt->encode($all->kdpro).'';?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
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