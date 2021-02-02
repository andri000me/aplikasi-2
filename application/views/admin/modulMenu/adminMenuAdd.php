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
              <li class="breadcrumb-item active"><small><a href="<?= base_url('admin/nMenuAdd')?>"><?= $page ;?></small></a></li>
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
            <form action="<?= base_url('admin/nMenuAdd'); ?>" method="POST">
              <div class="modal-body">
                <div class="form-group <?php if(form_error('menuTitleAdd')) {echo 'text-danger';}?>">
                  <label for="menuTitleAdd">Menu Title</label>
                  <input type="text" name="menuTitleAdd" class="form-control <?php if(form_error('menuTitleAdd')) {echo 'is-invalid';}?>" id="menuTitleAdd" placeholder="Menu title">
                  <?php echo form_error('menuTitleAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuForAdd')) {echo 'text-danger';}?>">
                  <label for="menuForAdd">Menu For</label>
                  <select name="menuForAdd" id="menuForAdd" class="form-control select2 <?php if(form_error('menuForAdd')) {echo 'select2-danger';}?>" <?php if(form_error('menuForAdd')) {echo 'data-dropdown-css-class="select2-danger"';}?> style="width: 100%">
                    <option value="">Select Menu For</option>
                    <?php foreach($allrole as $row) : ?>
                      <option value="<?= $row->id?>"><?= $row->access ;?></option>
                    <?php endforeach;?>
                  </select>
                  <?php echo form_error('menuForAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuUrlAdd')) {echo 'text-danger';}?>">
                  <label for="menuUrlAdd">Menu Url</label>
                  <input type="text" name="menuUrlAdd" class="form-control <?php if(form_error('menuUrlAdd')) {echo 'is-invalid';}?>" id="menuUrlAdd" placeholder="Menu url">
                  <?php echo form_error('menuUrlAdd', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group <?php if(form_error('menuIconAdd')) {echo 'text-danger';}?>">
                  <label for="menuIconAdd">Menu Icon</label>
                  <input type="text" name="menuIconAdd" class="form-control <?php if(form_error('menuIconAdd')) {echo 'is-invalid';}?>" id="menuIconAdd" placeholder="nav-icon fa-fw fas fa-tachometer-alt">
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
                <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/nMenu');?>">
                  <i class="fas fa-arrow-left"></i>&ensp;Back 
                </a>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&ensp;Add</button>
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

      }
    </script>