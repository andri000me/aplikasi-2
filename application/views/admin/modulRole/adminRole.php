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
              <li class="breadcrumb-item active"><small><a href="<?= base_url('admin/nRole')?>"><?= $page ;?></small></a></li>
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
            <a class="btn btn-sm btn-outline-info float-right" href="#" data-toggle="modal" data-target="#roleAdd">
              <i class="fas fa-plus"></i> Add Role
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
                    <th scope="col">Access</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach ($allrole as $alro) :  $i++;?>
                  <tr>
                    <th scope="row"><?= $i ;?></th>
                    <td><?= $alro->access; ?></td>
                    <td>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#roleDetail<?= $alro->id?>" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#roleEdit<?= $alro->id?>"  title="Edit"><i class="fas fa-edit text-warning"></i></a>
                      <a href="#" data-toggle="modal" data-target="#roleDelete<?= $alro->id?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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

    <!-- Role Modal Add-->
    <div class="modal fade" id="roleAdd">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title">Add New Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/nRole'); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="addRoleName">Role Name</label>
                <input type="text" name="a" class="form-control" id="addRoleName" placeholder="Role Name">
                <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Close</button>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- ROle Detail Modal -->
    <?php $i=0; foreach($allrole as $alro) : $i++; ?>
    <div class="modal fade" id="roleDetail<?= $alro->id?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title">Detail Role "<?= $alro->access;?>"</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label id="detailRoleName">Role Name</label>
                <input type="text" disabled class="form-control" for="detailRoleName" placeholder="Role Name" value="<?= $alro->access;?>">
              </div>
            </div>
            <div class="modal-footer" style='clear:both'>
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Close</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <?php endforeach; ?>
  <!-- /.modal -->

  <!-- Role Edit Modal -->
  <?php $i=0; foreach($allrole as $alro) : $i++; ?>
  <div class="modal fade" id="roleEdit<?= $alro->id?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header btn-warning">
          <h5 class="modal-title">Edit Role "<?= $alro->access;?>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/nRoleEdit'); ?>" method="post">
          <div class="modal-body">

            <input type="hidden" readonly value="<?= $alro->id ;?>" name="b" class="form-control" >

            <div class="form-group">
              <label id="editRoleName">Role Name</label>
              <input type="text" name="a" class="form-control" for="editRoleName" placeholder="Role Name" value="<?= $alro->access;?>">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Close</button>
            <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>&ensp;Update</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>
<!-- /.modal -->

<!-- Role Hapus Modal-->
<?php $i=0; foreach($allrole as $alro) : $i++; ?>
<div class="modal fade" id="roleDelete<?= $alro->id ;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Delete Role <?= $alro->access ;?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Delete" dibawah untuk menghapus Role <?= $alro->access;?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
        <a class="btn btn-danger btn-sm" href="<?= base_url('admin/nRoleDelete/').$alro->id.'';?>"><i class="fas fa-trash"></i>&ensp;Delete</a>
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