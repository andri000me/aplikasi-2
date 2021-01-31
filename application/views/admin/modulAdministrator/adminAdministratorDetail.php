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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministratorDetail/'.$this->encrypt->encode($oneadm->id))?>"><small><?= $page ?></small></a></li>
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
            <h3 class="card-title">Detail Data "<?php echo $oneadm->username;?>"</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row">
                <label for="detaildAdministratorUsername" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" id="detaildAdministratorUsername" placeholder="Username" value="<?php echo $oneadm->username;?>" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="detaildAdministratorFullName" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="detaildAdministratorFullName" placeholder="Fullname" value="<?php echo $oneadm->fullname?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="detaildAdministratorEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" id="detaildAdministratorEmail" placeholder="Email" value="<?php echo $oneadm->email; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-2">
                 <label for="detaildAdministratorImage"  class="col-form-label">Picture</label>
               </div>
               <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-3">
                    <img src="<?php echo base_url('assets/esurat/img/profile/').$oneadm->image;?>" id="detaildAdministratorImage" class="img-thumbnail" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="detaildAdministratorPhone" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" id="detaildAdministratorPhone" placeholder="Number Phone" value="<?php echo $oneadm->phone; ?>" disabled>
                </div>
              </div>
            </div>
            <div class="form-group row ml-3  mr-3">
              <label for="detaildAdministratorAddress" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="detaildAdministratorAddress" rows="3" placeholder="Addess" disabled><?php echo $oneadm->address; ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="detaildAdministratorActive" class="col-sm-2 col-form-label">Active</label>
              <div class="col-sm-10">
                <?php if($oneadm->is_active > 0) : ?>
                  <?php $active = "Active";?>
                  <input type="text" class="form-control" id="detaildAdministratorActive" placeholder="Is Active ?" value="<?php echo $active; ?>" disabled>
                  <?php else : ?>
                   <?php $active = "Belum";?>
                   <input type="text" class="form-control" id="detaildAdministratorActive" placeholder="Is Active ?" value="<?php echo $active; ?>" disabled>
                 <?php endif;?>
               </div>
             </div>
             <div class="form-group row">
              <label for="detaildAdministratorDateCreated" class="col-sm-2 col-form-label">Date Created</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" id="detaildAdministratorDateCreated" placeholder="Date Created" value="<?php echo date('d F Y',$oneadm->date_created); ?>" disabled>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dAdministrator');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Back
            </a>
            <a class="btn btn-warning btn-sm float-right" href="<?php echo base_url('admin/dAdministratorEdit/'). $this->encrypt->encode($oneadm->id).'';?>">
              <i class="fas fa-user-edit"></i>&ensp;Edit
            </a>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
  </section>