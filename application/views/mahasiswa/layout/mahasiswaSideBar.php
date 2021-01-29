     <!-- Brand Logo -->
     <a href="<?= base_url('mahasiswa')?>" class="brand-link">
      <img src="<?= base_url('');?>assets/AdminLTE-3.1.0-rc/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">E-Surat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <div class="card-body box-profile">
        <div class="text-center">
          <?php if(file_exists('assets/esurat/img/mhs/'.$user->nim.'.jpg')) :?>
            <img class="profile-user-img img-fluid img-circle"
            src="<?= base_url('assets/esurat/img/mhs/'.$user->nim.'.jpg') ; ?>"
            alt="User profile picture">
            <?php else : ?>
              <img class="profile-user-img img-fluid img-circle"
              src="<?= base_url('assets/esurat/img/mhs/default.jpg'); ?>"
              alt="User profile picture">
            <?php endif;?>
          </div>
          <h3 class="profile-username text-center text-white"><?= $user->nmmhs; ?></h3>
          <p class="text-muted text-center"><?= $user->status; ?></p>
        </div>
        <!-- /.card-body -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

       <li class="nav-header" >Main Navigation</li>
       <?php 
       $menu = $this->db->get_where('esurat_menu',['role_id' => 2, 'is_main_menu' => 0, 'is_active' => 1 ])->result();
       foreach ($menu as $me) {
        $treeMenu = $this->db->get_where('esurat_menu', ['is_main_menu' => $me->id_menu]);
        if($treeMenu->num_rows() > 0){
          echo '<li class="nav-item has-treeview">';
          if($page == $me->title){
            echo '<a href="'.base_url($me->url).'" class="nav-link active">';
          }else{
            echo '<a href="'.base_url($me->url).'" class="nav-link">';
          }
          echo '<i class="'.$me->icon.'"></i>
          <p>' 
          .$me->title. 
          '<i class="right fas fa-angle-left"></i>
          </p>
          </a>';
          echo '<ul class="nav nav-treeview" style="background : #1e282c;">';
          foreach ($treeMenu->result() as $treme) {
            echo '<li class="nav-item">';
            if($page == $treme->title){
              echo '<a href="'.base_url($treme->url).'" class="nav-link active">';
            }else{
              echo '<a href="'.base_url($treme->url).'" class="nav-link">';
            }
            echo '<i class="'.$treme->icon.'"></i>
            <p>' 
            .$treme->title. 
            '</p>
            </a>';
          }
          echo '</ul></li>';
        }else{
          echo '<li class="nav-item">';
          if($page == $me->title){
            echo '<a href="'.base_url($me->url).'" class="nav-link active">';
          }else{
            echo '<a href="'.base_url($me->url).'" class="nav-link">';
          }
          echo '<i class="'.$me->icon.'"></i>
          <p>' 
          .$me->title. 
          '</p>
          </a>
          </li>';
        }
      } 
      ;?>
      <li class="nav-item">
        <a href="<?php echo base_url('home/logout')?>" class="nav-link" data-toggle="modal" data-target="#logOutModal">
          <i class="nav-icon fa-fw fas fa-sign-out-alt"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->