    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>"><small>Admin</small></a></li>
              <li class="breadcrumb-item active"><small><?= $page ;?></small></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <?php if($hasil == NULL) {
          echo '
          <div class="row">
          <div class="col-12">
          <div class="callout callout-danger">
          <h5><i class="fas fa-info"></i> Note:</h5>
          Silahkan Melengkapi Form Untuk Menampilkan Data yang di inginkan
          </div>
          </div>
          <!--/. Col -->
          </div>
          ';
        }?>

        <!-- Row Form Select Tabel -->
        <div class="row">
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Pilih Jenis Surat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?php echo base_url('admin/laporan')?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Surat</label>
                    <select name="status" class="form-control select2 <?php if(form_error('status')) {echo 'select2-danger';}?>" <?php if(form_error('status')) {echo 'data-dropdown-css-class="select2-danger"';}?> style="width: 100%;" value="<?= set_value('status');?>">
                      <option value="<?= set_value('status');?>">-- Pilih Status Surat --</option>
                      <option value="PENDING">Status Surat Pending</option>
                      <option value="CONFIRM">Status Surat Confirm</option>
                    </select>
                    <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIM</label>
                    <select name="permintaan_by" class="form-control select2" style="width: 100%;">
                      <option value="">Ketik Nama / NIM</option>
                      <?php
                      foreach ($nimlaporan as $row) {
                        echo '<option value="'.$row->nim.'">'.$row->nim. '/' .$row->nmmhs.'</option>';
                      }
                      ?>

                    </select>
                    <text class="text-danger"><small>Biarkan Kosong Jika Ingin menampilkan Semuanya</small></text>
                    <?php echo form_error('permintaan_by', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label>Periode:</label>
                    <div class="row">

                      <div class="col-md-5 ">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="datetime-local" name="awalPeriode" class="form-control <?php if(form_error('awalPeriode')) {echo 'is-invalid';}?>" id="reservation" value="<?= set_value('awalPeriode');?>">
                          
                        </div>
                        <?php echo form_error('awalPeriode', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <div class=" text-center" style="width:  60px;">
                        <p  class="form-control">S.D</p>
                      </div>
                      <div class="col-md-5 ">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="datetime-local" name="akhirPeriode" class="form-control <?php if(form_error('akhirPeriode')) {echo 'is-invalid';}?>" id="akhir" value="<?= set_value('akhirPeriode');?>">

                        </div>
                        <?php echo form_error('akhirPeriode', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer justify-content-between">
                  <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/laporan');?>"><i class="fas fa-times"></i>&ensp;Reset</a>
                  <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-sign-in-alt"></i>&ensp;Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-12">
            <?php 

            $status = $this->input->post('status');
            $nim = $this->input->post('permintaan_by');
            $awal = $this->input->post('awalPeriode');
            $akhir = $this->input->post('akhirPeriode');

            switch ($status) {

              case 'PENDING':

              if($hasil == NULL){

                $out = '<div class="card card-outline card-info">
                <div class="card-header">
                <h4 class="card-title" text-align="center"><strong>Surat pending</strong></h4>
                </div>
                <div class="card-body">
                Data Yang Anda inginkan Tidak Ada
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->';

              }else{

                $out = '<div class="card card-outline card-secondary">
                <div class="card-header">
                <h3 class="card-title mt-2">
                <i class="fas fa-th mr-1"></i>';
                $out .= 'Permintaan Surat';
                $out .= '</h3>
                <div class="btn-group float-right">
                <div class="row">
                <form action="'. base_url('admin/laporanpdf').'" method="post" target="blank" >
                <input type="hidden" readonly value="permintaanSurat" name="status" class="form-control" >
                <input type="hidden" readonly value ="'.set_value('permintaan_by').'" name="b" class="form-control" >
                <input type="hidden" readonly value ="'.set_value('awalPeriode').'" name="c" class="form-control" >
                <input type="hidden" readonly value ="'.set_value('akhirPeriode').'" name="d" class="form-control" >
                <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
                </form>
                &ensp;
                </div>


                </div>
                </div>
                <div class="card-body">
                <div>
                <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">No Surat</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Pengajuan By</th>
                <th scope="col">Tanggal Pengajuan</th>
                </tr>
                </thead>
                <tbody>';
                $i=0; foreach($hasil as $lap): $i++;
                $out .='<tr>';
                $out .='<th scope="row">' .$i.'</th>';                
                $out .='<td>'. $lap->no_surat .'</td>';
                $out .='<td>' .$lap->nm_surat. '</td>';
                $out .='<td>' .$lap->perminttan_by. '</td>';
                $out .='<td>' . date('d F Y', strtotime($lap->permintaan_tgl)). '</td>';
                $out .='</tr>';
              endforeach;

              $out .= '</tbody>
              </table>
              </div>
              <!-- /.row -->
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->';

            }

            break;

            case 'CONFIRM':

            if($hasil == NULL){

              $out = '<div class="card card-outline card-info">
              <div class="card-header">
              <h3 class="card-title mt-2">
              <i class="fas fa-th mr-1"></i>';
              $out .= 'Surat Konfirmasi';
              $out .= '</h3>
              </div>
              <div class="card-body">
              Data Yang Anda inginkan Tidak Ada
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->';

            }else{
              $out = '<div class="card card-outline card-secondary">
              <div class="card-header">
              <h3 class="card-title mt-2">
              <i class="fas fa-th mr-1"></i>';
              $out .= 'Surat Konfirmasi';
              $out .= '</h3>
              <div class="btn-group float-right">
              <div class="row">
              <form action="'. base_url('admin/laporanpdf').'" method="post" target="blank" >
              <input type="hidden" readonly value="suratSelesai" name="status" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('permintaan_by').'" name="b" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('awalPeriode').'" name="c" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('akhirPeriode').'" name="d" class="form-control" >
              <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
              </form>
              &ensp;

              </div>


              </div>
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

              <table id="example" class="table table-bordered table-striped display nowrap" style="width:100%">
              <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">No Surat</th>
              <th scope="col">Jenis Surat</th>
              <th scope="col">Pengajuan By</th>
              <th scope="col">Tanggal Pengajuan</th>
              <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>';
              $i=0; foreach($hasil as $lap): $i++;
              $out .='<tr>';
              $out .='<th scope="row">' .$i.'</th>';                
              $out .='<td>'. $lap->no_surat .'</td>';
              $out .='<td>' .$lap->nm_surat. '</td>';
              $out .='<td>' .$lap->permintaan_by. '</td>';
              $out .='<td>' . date('d F Y', strtotime($lap->permintaan_tgl)). '</td>';
              $out .='<td>'. $lap->no_surat .'</td>';
              $out .='</tr>';
            endforeach;

            $out .= '</tbody>
            </table>
            <!-- /.row -->
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->';
          }

          break;

          default:
          $out = '

          ';
          break;

        };

        echo $out;
        ?>
      </div>
    </div>
    <!-- Default box -->

  </section>
<!-- /.content -->