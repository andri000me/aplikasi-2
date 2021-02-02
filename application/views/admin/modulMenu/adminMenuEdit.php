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
              <li class="breadcrumb-item active"><small><a href="<?= base_url('admin/nMenuedit/'.$this->encrypt->encode($onemenu->id_menu))?>"><?= $page ;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->          
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Default box -->
        <div class="card card-outline card-info">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
          </div>
          <div class="card-body">
            <form action="<?= base_url('admin/nMenuEdit/'.$this->encrypt->encode($onemenu->id_menu)); ?>" method="POST">
              <div class="modal-body">
                <div class="form-group <?php if(form_error('menuTitleEdit')) {echo 'text-danger';}?>">
                  <label for="menuTitleEdit">Menu Title</label>
                  <input type="text" name="menuTitleEdit" class="form-control <?php if(form_error('menuTitleEdit')) {echo 'is-invalid';}?>" id="menuTitleEdit" placeholder="Menu title" value="<?= $onemenu->title?>">
                  <?php echo form_error('menuTitleEdit', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuForEdit')) {echo 'text-danger';}?>">
                  <label for="menuForEdit">Menu For</label>
                  <select name="menuForEdit" id="menuForEdit" class="form-control select2 <?php if(form_error('menuForEdit')) {echo 'select2-danger';}?>" <?php if(form_error('menuForEdit')) {echo 'data-dropdown-css-class="select2-danger"';}?> style="width: 100%">


                    <?php foreach($allrole as $row) :?>

                      <?php if($row->id == $onemenu->role_id) : ?>
                        <option value="<?= $row->id?>" selected><?= $row->access?></option>
                        <?php else:?>
                         <option value="<?= $row->id?>"><?= $row->access?></option>
                       <?php endif;?>

                     <?php endforeach; ?>

                   </select>
                   <?php echo form_error('menuForEdit', '<small class="text-danger pl-3">', '</small>');?>
                 </div>
                 <div class="form-group <?php if(form_error('menuUrlEdit')) {echo 'text-danger';}?>">
                  <label for="menuUrlEdit">Menu Url</label>
                  <input type="text" name="menuUrlEdit" class="form-control <?php if(form_error('menuUrlEdit')) {echo 'is-invalid';}?>" id="menuUrlEdit" placeholder="Menu url" value="<?= $onemenu->url?>">
                  <?php echo form_error('menuUrlEdit', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuIconEdit')) {echo 'text-danger';}?>">
                  <label for="menuIconEdit">Menu Icon</label>
                  <input type="text" name="menuIconEdit" class="form-control <?php if(form_error('menuIconEdit')) {echo 'is-invalid';}?>" id="menuIconEdit" placeholder="nav-icon fa-fw fas fa-tachometer-alt" value="<?= $onemenu->icon?>">
                  <?php echo form_error('menuIconEdit', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                  <label for="menuTreeEdit">Menu Tree / <text style="color: red">Bisa dikosongkan</text></label>
                  <select name="menuTreeEdit" id="menuTreeEdit" class="form-control select2" style="width: 100%">
                    <?php if($onemenu->is_main_menu == 0) :?>
                      <option value="0">Kosong</option>
                      <?php else :?>
                        <?php foreach($allmenu as $field) :?>
                          <?php if($field->id_menu == $onemenu->is_main_menu) :?>
                            <option value="<?= $field->id_menu?>"><?= $field->title?></option>
                          <?php endif;?>
                        <?php endforeach;?>
                      <?php endif;?>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <?php 
                      if($onemenu->is_active == 1){
                        echo '<input class="form-check-input" value="1" name="menuActiveEdit" type="checkbox" for="editSubMenuActive" checked>';
                      }else{
                        echo '<input class="form-check-input" value="1" name="menuActiveEdit" type="checkbox" for="editSubMenuActive">';
                      }
                      ;?>
                      <label class="form-check-label" for="menuActiveAdd">
                        Active?
                      </label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/nMenu');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back 
                  </a>
                  <button type="submit" class="btn btn-warning btn-sm float-right "><i class="fas fa-user-edit"></i>&ensp;Update</button>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
      </section>


      <script type="text/javascript">
        window.onload = function () {

          $('#menuForEdit').change(function(){
            var role_id = $('#menuForEdit').val();
            if(role_id == ''){
              document.getElementById("menuTreeEdit").innerHTML = '<option value="0">Select Menu For First</option>';
            }else{
              $.ajax({
                url:baseURL+'ajax/fetchAddMenu',
                method:"POST",
                data:{role_id:role_id},
                success:function(data){
                  $('#menuTreeEdit').html(data);
                }
              })
            }
          });

        }
      </script>