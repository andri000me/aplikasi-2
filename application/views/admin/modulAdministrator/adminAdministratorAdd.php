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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministrator')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministratorAdd')?>"><small><?= $page ?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->            
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $page; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dAdministratorAdd')?>" method="post">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row <?php if(form_error('username')) {echo 'text-danger';}?>">
                <label for="addUserSettings" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" name="username" class="form-control <?php if(form_error('username')) {echo 'is-invalid';}?>" id="addUserSettings" placeholder="Username" value="<?php echo set_value('username');?>" autocomplete="off">
                  </div>
                  <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('password')) {echo 'text-danger';}?>">
                <label for="addPasswordSett" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control <?php if(form_error('password')) {echo 'is-invalid';}?>" id="addPasswordSett" placeholder="Password" autocomplete="off">
                  <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row <?php if(form_error('repeatpassword')) {echo 'text-danger';}?>">
                <label for="addPasswordSettings" class="col-sm-2 col-form-label">Retry Password</label>
                <div class="col-sm-10">
                  <input type="password" name="repeatpassword" class="form-control <?php if(form_error('repeatpassword')) {echo 'is-invalid';}?>" id="addPasswordSettings" placeholder="Retry Password" autocomplete="off">
                  <?php echo form_error('repeatpassword', '<small class="text-danger pl-3">', '</small>');?> 
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dAdministrator');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->