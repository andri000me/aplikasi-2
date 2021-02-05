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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/nMenu')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item active"><small><a href="<?= base_url('admin/nMenuDetail/'.$this->encrypt->encode($onemenu->id_menu).'')?>"><?= $page ;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->          
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Default box -->
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
          </div>
          <div class="card-body">
            <form action="<?= base_url('admin/nMenuAdd'); ?>" method="POST">
              <div class="modal-body">
                <div class="form-group <?php if(form_error('menuTitleAdd')) {echo 'text-danger';}?>">
                  <label for="menuTitleAdd">Menu Title</label>
                  <input type="text" name="menuTitleAdd" class="form-control <?php if(form_error('menuTitleAdd')) {echo 'is-invalid';}?>" id="menuTitleAdd" placeholder="Menu title" value="<?= $onemenu->title?>" readonly>
                  <?php echo form_error('menuTitleAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuForAdd')) {echo 'text-danger';}?>">
                  <label for="menuForAdd">Menu For</label>
                  <?php foreach($allrole as $row) : ?>
                    <?php if($row->id == $onemenu->role_id) : ?>
                      <input type="text" name="menuForAdd" class="form-control <?php if(form_error('menuForAdd')) {echo 'is-invalid';}?>" id="menuTitleAdd" placeholder="Menu title" value="<?= $row->access?>" readonly>
                    <?php endif;?>
                  <?php endforeach;?>
                  <?php echo form_error('menuForAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuUrlAdd')) {echo 'text-danger';}?>">
                  <label for="menuUrlAdd">Menu Url</label>
                  <input type="text" name="menuUrlAdd" class="form-control <?php if(form_error('menuUrlAdd')) {echo 'is-invalid';}?>" id="menuUrlAdd" placeholder="Menu url" value="<?= $onemenu->url?>" readonly>
                  <?php echo form_error('menuUrlAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuIconAdd')) {echo 'text-danger';}?>">
                  <label for="menuIconAdd">Menu Icon</label>
                  <input type="text" name="menuIconAdd" class="form-control <?php if(form_error('menuIconAdd')) {echo 'is-invalid';}?>" id="menuIconAdd" placeholder="fa-fw fas-home" value="<?= $onemenu->icon?>" readonly>
                  <?php echo form_error('menuIconAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                  <label for="menuTreeAdd">Menu Tree / <text style="color: red">Bisa dikosongkan</text></label>

                  <?php if($onemenu->is_main_menu == '0') :?>
                    <input type="text" name="menuIconAdd" class="form-control" id="menuIconAdd" placeholder="Tree Menu" value="Kosong" readonly>
                    <?php else :?>
                      <?php foreach($allmenu as $field) :?>
                        <?php if($onemenu->is_main_menu == $field->id_menu) :?>
                          <input type="text" name="menuIconAdd" class="form-control" id="menuIconAdd" placeholder="Tree Menu" value="<?= $field->title?>" readonly> 
                        <?php endif;?>
                      <?php endforeach;?>
                    <?php endif;?>

                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <?php if($onemenu->is_active == '1'):?>
                        <input class="form-check-input" value="1" name="menuActiveAdd" type="checkbox" value="1" id="menuActiveAdd" checked disabled="">
                        <label class="form-check-label" for="menuActiveAdd">
                          Active
                        </label>
                        <?php else :?>
                          <input class="form-check-input" value="1" name="menuActiveAdd" type="checkbox" value="1" id="menuActiveAdd" disabled="">
                          <label class="form-check-label" for="menuActiveAdd">
                            Not Active
                          </label>
                        <?php endif;?>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/nMenu');?>">
                      <i class="fas fa-arrow-left"></i>&ensp;Back 
                    </a>
                    <a class="btn btn-warning float-right btn-sm" href="<?= base_url('admin/nMenuEdit/'). $this->encrypt->encode($onemenu->id_menu).'';?>">
                      <i class="fas fa-edit"></i>&ensp;Edit 
                    </a>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.container-fluid -->
        </section>