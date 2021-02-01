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
            <a class="btn btn-sm btn-outline-info float-right" href="#" data-toggle="modal" data-target="#menuAdd">
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
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#menuDetail<?= $alme->id_menu?>" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#menuEdit<?= $alme->id_menu?>" title="Edit"><i class="fas fa-edit text-warning"></i></a>
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

    <!-- Menu Modal Add-->
    <div class="modal fade" id="menuAdd">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title">Add New Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="menu_add" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label for="menuTitleAdd">Menu Title</label>
                <input type="text" name="menuTitleAdd" class="form-control" id="menuTitleAdd" placeholder="Menu title">
                <?php echo form_error('menuTitleAdd', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="menuForAdd">Menu For</label>
                <select name="menuForAdd" id="menuForAdd" class="form-control" style="width: 100%">
                  <option value="">Select Menu For</option>
                  <option value="1">Admin</option>
                  <option value="2">Mahasiswa</option>
                </select>
                <?php echo form_error('menuForAdd', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="menuUrlAdd">Menu Url</label>
                <input type="text" name="menuUrlAdd" class="form-control" id="menuUrlAdd" placeholder="Menu url">
                <?php echo form_error('menuUrlAdd', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="menuIconAdd">Menu Icon</label>
                <input type="text" name="menuIconAdd" class="form-control" id="menuIconAdd" placeholder="Menu icon">
                <?php echo form_error('menuIconAdd', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="menuTreeAdd">Menu Tree / <text style="color: red">Bisa dikosongkan</text></label>
                <select name="menuTreeAdd" id="menuTreeAdd" class="form-control select2" style="width: 100%">
                  <option value="0">Select Menu For First</option>
                </select>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" value="1" name="menuActiveAdd" type="checkbox" value="1" id="menuActiveAdd" checked>
                  <label class="form-check-label" for="menuActiveAdd">
                    Active?
                  </label>
                </div>
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

    <!-- Menu Detail Modal -->
    <?php $i=0; foreach($allmenu as $alme) : $i++; ?>
    <div class="modal fade" id="menuDetail<?= $alme->id_menu ;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title">Detail Menu "<?= $alme->title;?>"</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label id="detailMenuTitle">Menu Title</label>
                <input type="text" disabled class="form-control" for="detailMenuTitle" placeholder="Menu title" value="<?= $alme->title;?>">
              </div>
              <div class="form-group">
                <label id="detailMenuMfor">Menu For</label>
                <?php if($alme->role_id == 1){
                  echo '<input type="text" disabled class="form-control" for="detailMenuUrl" placeholder="Menu url" value="Admin">';
                }else{
                  echo '<input type="text" disabled class="form-control" for="detailMenuUrl" placeholder="Menu url" value="Mahasiswa">';
                };?>
              </div>
              <div class="form-group">
                <label id="detailMenuUrl">Menu Url</label>
                <input type="text" disabled class="form-control" for="detailMenuUrl" placeholder="Menu url" value="<?= $alme->url;?>">
              </div>
              <div class="form-group">
                <label id="detailMenuIcon">Menu Icon</label>
                <input type="text" disabled class="form-control" for="detailMenuIcon" placeholder="Menu icon" value="<?= $alme->icon;?>">
              </div>
              <div class="form-group">
                <label id="detailMenuTree">Menu Tree</label>
                <?php 
                $treeMenu = $this->db->get_where('esurat_menu',['id_menu' => $alme->is_main_menu])->row_array();
                if($treeMenu['id_menu'] == $alme->is_main_menu){
                  echo '<input type="text" disabled class="form-control" for="detailMenuTree" placeholder="Menu Tree" value="'.$treeMenu['title'].'">';
                }else{
                  echo '<input type="text" disabled class="form-control" for="detailMenuTree" placeholder="Menu Tree" value="Kosong">';
                }
                ;?>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <?php 
                  if($alme->is_active == 1){
                    echo '<input class="form-check-input" value="1" name="f" type="checkbox" for="editSubMenuActive" checked disabled>';
                  }else{
                    echo '<input class="form-check-input" value="1" name="f" type="checkbox" for="editSubMenuActive" disabled>';
                  }
                  ;?>
                  <label class="form-check-label" id="editSubMenuActive">Active?</label>
                </div>
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

  <!-- Menu Edit Modal -->
  <?php $i=0; foreach($allmenu as $alme) : $i++; ?>
  <div class="modal fade" id="menuEdit<?= $alme->id_menu ;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header btn-warning">
          <h5 class="modal-title">Edit Menu "<?= $alme->title;?>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="menu_edit" method="post">
          <div class="modal-body">

            <input type="hidden" readonly value="<?= $alme->id_menu ;?>" id="menuEdit" class="form-control" >

            <div class="form-group">
              <label for="menuTitleEdit">Menu Title</label>
              <input type="text" name="menuTitleEdit" class="form-control" id="menuTitleEdit" placeholder="Menu Title" value="<?= $alme->title;?>">
              <?php echo form_error('menuTitleEdit', '<small class="text-danger pl-3">', '</small>');?>
            </div>
            <div class="form-group">
              <label for="menuForEdit">Menu For</label>
              <select name="menuForEdit" id="menuForEdit" class="form-control">
                <?php
                foreach ($role as $rol) {
                  if($alme->role_id == $rol->id){
                    echo '<option value="'.$rol->id.'" selected>'.$rol->access.'</option>';
                  }else{
                    echo '<option value="'.$rol->id.'">'.$rol->access.'</option>';
                  }
                }
                ;?>
              </select>
              <?php echo form_error('menuForEdit', '<small class="text-danger pl-3">', '</small>');?>
            </div>
            <div class="form-group">
              <label for="editMenuUrl">Menu Url</label>
              <input type="text" name="editMenuUrl" class="form-control" id="editMenuUrl" placeholder="Menu url" value="<?= $alme->url;?>">
              <?php echo form_error('editMenuUrl', '<small class="text-danger pl-3">', '</small>');?>
            </div>
            <div class="form-group">
              <label for="menuIconEdit">Menu Icon</label>
              <input type="text" name="menuIconEdit" class="form-control" id="menuIconEdit" placeholder="Menu icon" value="<?= $alme->icon;?>">
              <?php echo form_error('menuIconEdit', '<small class="text-danger pl-3">', '</small>');?>
            </div>
            <div class="form-group">
              <label for="menuTreeEdit">Menu Tree</label>
              <select name="menuTreeEdit" id="menuTreeEdit" class="form-control select2" style="width: 100%">
                <option value="0">Select Menu Tree</option>
                <option  value="0" selected>Kosong</option>
              </select>
              <?php echo form_error('menuTreeEdit', '<small class="text-danger pl-3">', '</small>');?>
            </div>
            <div class="form-group">
              <div class="form-check">
                <?php 
                if($alme->is_active == 1){
                  echo '<input class="form-check-input" value="1" name="menuActiveEdit" type="checkbox" id="menuActiveEdit" checked>';
                }else{
                  echo '<input class="form-check-input" value="0" name="menuActiveEdit" type="checkbox" id="menuActiveEdit">';
                }
                ;?>
                <label class="form-check-label" for="menuActiveEdit">Active?</label>
              </div>
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

<script type="text/javascript">

  window.onload = function () {

    $('#menuForAdd').change(function(){
      var role_id = $('#menuForAdd').val();
      if(role_id == ''){
        document.getElementById("menuTreeAdd").innerHTML = '<option value="0">Select Menu For First</option>';
      }else{
        $.ajax({
          url:baseURL+'ajax/fetchAddMenu',
          method:"POST",
          data:{role_id:role_id},
          success:function(data){
            $('#menuTreeAdd').html(data);
          }
        })
      }
    });

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

    $('#menu_add').on('submit', function(event){
      event.preventDefault();
      var menuTitleAdd = $('#menuTitleAdd').val();
      var menuForAdd = $('#menuForAdd').val();
      var menuUrlAdd = $('#menuUrlAdd').val();
      var menuIconAdd = $('#menuIconAdd').val();
      var menuTreeAdd = $('#menuTreeAdd').val();
      var menuActiveAdd = $('#menuActiveAdd').val();
      $.ajax({
        type:'POST',
        url:baseURL+'admin/nMenuAdd',
        data: {
          menuTitleAdd:menuTitleAdd,
          menuForAdd:menuForAdd,
          menuUrlAdd:menuUrlAdd,
          menuIconAdd:menuIconAdd,
          menuTreeAdd:menuTreeAdd,
          menuActiveAdd:menuActiveAdd
        },
        dataType: 'json',
        success: function(data){
          if (data.success == true ){
            if (data.url == true) {
              Swal.fire({
                icon: data.type,
                title: data.title,
                text:data.nama,
                showConfirmButton: false,
                timer: 2000
              }).then((result) => {
                window.location.href = data.redirect;
              });
            }else{
              Swal.fire({
                icon: data.type,
                title: data.title,
                text:data.nama,
                showConfirmButton: false,
                timer: 2000
              });
            };
          }else{
            $.each(data.messages, function(key, value){
              var element = $('#' + key);
              element.closest('.form-control')
              .removeClass('is-invalid')
              .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
              element.closest('div.form-group').find('.text-danger')
              .remove();
              element.after(value);
            });
          }
        }  
      });
    })

    $('#menu_edit').on('submit', function(event){
      event.preventDefault();
      var menuTitleEdit = $('#menuTitleEdit').val();
      var menuForEdit = $('#menuForEdit').val();
      var menuUrlEdit = $('#menuUrlEdit').val();
      var menuIconEdit = $('#menuIconEdit').val();
      var menuTreeEdit = $('#menuTreeEdit').val();
      var menuActiveEdit = $('#menuActiveEdit').val();
      $.ajax({
        type:'POST',
        url:baseURL+'admin/nMenuEdit',
        data: {
          menuTitleEdit:menuTitleEdit,
          menuForEdit:menuForEdit,
          menuUrlEdit:menuUrlEdit,
          menuIconEdit:menuIconEdit,
          menuTreeEdit:menuTreeEdit,
          menuActiveEdit:menuActiveEdit
        },
        dataType: 'json',
        success: function(data){
          if (data.success == true ){
            if (data.url == true) {
              Swal.fire({
                icon: data.type,
                title: data.title,
                text:data.nama,
                showConfirmButton: false,
                timer: 2000
              }).then((result) => {
                window.location.href = data.redirect;
              });
            }else{
              Swal.fire({
                icon: data.type,
                title: data.title,
                text:data.nama,
                showConfirmButton: false,
                timer: 2000
              });
            };
          }else{
            $.each(data.messages, function(key, value){
              var element = $('#' + key);
              element.closest('.form-control')
              .removeClass('is-invalid')
              .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
              element.closest('div.form-group').find('.text-danger')
              .remove();
              element.after(value);
            });
          }
        }  
      });
    })

  }
</script>