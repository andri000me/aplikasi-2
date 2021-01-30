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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministratorEdit/'.$this->encrypt->encode($oneadm->id))?>"><small><?= $page ?></small></a></li>
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
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">Edit Data "<?php echo $oneadm->username;?>"</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php echo form_open_multipart('admin/dAdministratorEdit/'.$this->encrypt->encode($oneadm->id).'');?>
          <div class="card-body ml-3 mr-3">
            <div class="form-group row <?php if(form_error('username')) {echo 'text-danger';}?>">
              <label for="editdAdministratorUsername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" name="username" class="form-control <?php if(form_error('username')) {echo 'is-invalid';}?>" id="editdAdministratorUsername" placeholder="Username" value="<?php echo $oneadm->username;?>">
                </div>
                <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row <?php if(form_error('password')) {echo 'text-danger';}?>">
              <label for="editdAdministratorPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="text" name="password" class="form-control" id="editdAdministratorPassword" placeholder="Password">
                <small class="text-danger">Kosongkan Jika Tidak Ingin Mengganti Password</small>
                <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row <?php if(form_error('fullname')) {echo 'text-danger';}?>">
              <label for="editdAdministratorFullName" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" name="fullname" class="form-control <?php if(form_error('fullname')) {echo 'is-invalid';}?>" id="editdAdministratorFullName" placeholder="Fullname" value="<?php echo $oneadm->fullname?>">
                <?php echo form_error('fullname', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row <?php if(form_error('email')) {echo 'text-danger';}?>">
              <label for="editdAdministratorEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="text" name="email" class="form-control <?php if(form_error('email')) {echo 'is-invalid';}?>" id="editdAdministratorEmail" placeholder="Email" value="<?php echo $oneadm->email; ?>">
                </div>
                <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-2">
               <label for="editdAdministratorImage"  class="col-form-label">Picture</label>
             </div>
             <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url('assets/esurat/img/profile/').$oneadm->image;?>" id="editdAdministratorImage" class="img-thumbnail mb-2">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" name="picture" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                  <?php echo form_error('picture', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
            </div>`
          </div>
          <div class="form-group row <?php if(form_error('phone')) {echo 'text-danger';}?>">
            <label for="editdAdministratorPhone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" name="phone" class="form-control <?php if(form_error('phone')) {echo 'is-invalid';}?>" id="editdAdministratorPhone" value="<?php echo $oneadm->phone; ?>" data-inputmask='"mask": "9999-9999-99999"' placeholder="9999-9999-99999" data-mask>
              </div>
              <?php echo form_error('phone', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row <?php if(form_error('address')) {echo 'text-danger';}?>">
            <label for="editdAdministratorAddress" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <textarea class="form-control <?php if(form_error('address')) {echo 'is-invalid';}?>" name="address" id="editdAdministratorAddress" placeholder="Addess"><?php echo $oneadm->address; ?></textarea>
              <?php echo form_error('address', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row">
            <label for="editdAdministratorActive" class="col-sm-2 col-form-label">Active</label>
            <div class="col-sm-10">
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline" id="editdAdministratorActive">
                  <?php if($oneadm->is_active == 1) : ?>
                    <input class="form-check-input" value="1" name="status" type="checkbox" value="" id="checkboxPrimaryStatus" checked>
                    <?php else : ?>
                      <input class="form-check-input" value="1" name="status" type="checkbox" value="" id="checkboxPrimaryStatus" >
                    <?php endif; ?>
                    <label for="checkboxPrimaryStatus">
                      Status
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dAdministrator');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Back
            </a>
            <button type="submit" class="btn btn-warning btn-sm float-right "><i class="fas fa-user-edit"></i>&ensp;Update</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
  </section>

<script>
  window.onload = function () {

    /*-- Change Name Image on Update Profile --*/
    $('.custom-file-input').on('change', function(){
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    })
    /*-- /. Change Name Image on Update Profile --*/
  }
</script>