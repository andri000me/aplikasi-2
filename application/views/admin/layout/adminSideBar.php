      <!-- Brand Logo -->
      <a href="<?= base_url('admin')?>" class="brand-link">
        <img src="<?= base_url('assets/AdminLTE-3.1.0-rc/')?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Surat</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-header">MAIN NAVIGATION</li>
           <?php 
           $menu = $this->db->get_where('esurat_menu',['role_id' => $this->session->userdata('role'), 'is_main_menu' => 0, 'is_active' => 1 ])->result();
           foreach ($menu as $me) {
            $treeMenu = $this->db->get_where('esurat_menu', ['role_id' => $this->session->userdata('role'),'is_main_menu' => $me->id_menu, 'is_active' => 1 ]);
            if($treeMenu->num_rows() > 0){
              echo '<li class="nav-item has-treeview">';
              if($page == $me->title ){
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
              echo '<ul class="nav nav-treeview" >';
              foreach ($treeMenu->result() as $treme) {
                echo '<li class="nav-item">';
                if($page == $treme->title || $parent == $treme->title){
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
              echo '</li></ul>';
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
            <a href="<?php echo base_url('auth/logout')?>" class="nav-link" data-toggle="modal" data-target="#logOutModal">
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