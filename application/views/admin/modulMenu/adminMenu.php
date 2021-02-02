    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Admin</small></li>
              <li class="breadcrumb-item active"><small><a href="<?= base_url('admin/nMenu')?>"><?= $page ;?></small></a></li>
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
            <a class="btn btn-sm btn-outline-info float-right" href="<?= base_url('admin/nMenuAdd')?>">
              <i class="fas fa-plus"></i> Add Menu
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

            <table id="example" class="table table-bordered table-striped nowrap" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tittle</th>
                  <th scope="col">Url</th>
                  <th scope="col">Icon</th>
                  <th scope="col">Menu For</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($allmenu as $alme) :  $i++;?>
                <tr>
                  <th scope="row"><?= $i ;?></th>
                  <td><?= $alme->title; ?></td>
                  <td><?= $alme->url; ?></td>
                  <td><?= $alme->icon; ?></td>
                  <td>
                    <?php
                    if($alme->role_id == 1 ){
                      echo 'Admin';
                    }else{
                      echo 'Mahasiswa';
                    }
                    ?>
                  </td>
                  <td class="text-center">
                    <a style="margin-right:10px" href="<?= base_url('admin/nMenuDetail/'.$this->encrypt->encode($alme->id_menu))?>" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
                    <a style="margin-right:10px" href="<?= base_url('admin/nMenuEdit/'.$this->encrypt->encode($alme->id_menu))?>" title="Edit"><i class="fas fa-edit text-warning"></i></a>
                    <a href="#" data-toggle="modal" data-target="#menuDelete<?= $alme->id_menu?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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

 

<!-- Menu Hapus Modal-->
<?php $i=0; foreach($allmenu as $alme) : $i++; ?>
<div class="modal fade" id="menuDelete<?= $alme->id_menu ;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Delete Menu <?= $alme->title ;?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Delete" dibawah untuk menghapus Menu <?= $alme->title;?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
        <a class="btn btn-danger btn-sm" href="<?= base_url('admin/nMenudelete/').$this->encrypt->encode($alme->id_menu).'';?>"><i class="fas fa-trash"></i>&ensp;Delete</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>
<!-- /.modal -->

</section>
<!-- /.content -->