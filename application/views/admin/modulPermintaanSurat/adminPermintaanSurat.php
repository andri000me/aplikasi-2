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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sPermintaanSurat')?>"><small><?= $page ;?></small></a></li>
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


        <div class="card card-outline card-info collapsed-card">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong>Add Permintaan Surat</strong></h4>
            <div class="card-tools">
              <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
              </button>
              <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
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

            <table id="example" class="table table-bordered table-striped display" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">kode Surat</th>
                  <th scope="col">Nama Surat</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($surat as $cos) :  $i++;?>
                <tr>
                  <td><?= $i ;?></td>
                  <td><?php echo $cos->kd_surat; ?></td>
                  <td><?php echo $cos->nm_surat; ?></td>
                  <td>
                    <a class="btn btn-primary btn-sm" type="button" href="<?= base_url('permintaan/permintaanDetail/').$this->encrypt->encode($cos->kd_surat).'/'.$this->encrypt->encode($cos->id_surat).'/'.$this->encrypt->encode('permohonan');?>">Pilih Surat</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card card-outline card-info">
        <div class="card-header">
          <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>

        </div>
        <div class="card-body table-responsive">

          <div class="input-group ">
            <input class="form-control col-sm-12" name="seachPmr" id="seachPmr" type="text" placeholder="Search By NIM / Tgl Pengajuan" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>

          <table id="pmr_data" class="table table-bordered table-striped display nowrap" style="width:100%">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kd Surat</th>
                <th scope="col">No Surat</th>
                <th scope="col">Nama Surat</th>
                <th scope="col">Permintaan By</th>
                <th scope="col">Permintaan Tgl</th>
                <th scope="col">Status Surat</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <script type="text/javascript">

    window.onload = function () {

      /*-- DataTable To Load Data Mahasiswa --*/
      var permintaan = $('#pmr_data').DataTable({ 

        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
          "url": baseURL+'ajax/get_data_pmr',
          "type": "POST"

        },

        "columnDefs": [{ 

          "targets": [ 0 ], 
          "orderable": false, 

        }],

        "responsive": true

      });
      $('#seachPmr').keyup(function(){
        permintaan.search($(this).val()).draw() ;
      });
      /*-- /. DataTable To Load Data Mahasiswa --*/

    }

  </script>