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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sSuratSelesai')?>"><small><?= $page ;?></small></a></li>
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
        <!-- Default box -->
        <div class="card card-outline card-info">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>

          </div>
          <div class="card-body table-responsive">

            <div class="input-group ">
              <input class="form-control col-sm-12" name="seachMhs" id="seachMhs" type="text" placeholder="Search By NIM / Nama" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>

            <table id="sls_data" class="table table-bordered table-striped display nowrap" style="width:100%">
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

            <!-- /.row -->
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
        var mhs = $('#sls_data').DataTable({

          "sDom": 'lrtip',
          "lengthChange": false,
          "processing": true, 
          "serverSide": true, 
          "order": [],
          "ajax": {
            "url": baseURL+'ajax/get_data_sls',
            "type": "POST"

          },

          "columnDefs": [{ 

            "targets": [ 0 ], 
            "orderable": false, 

          }],

          "responsive": true

        });
        $('#seachMhs').keyup(function(){
          mhs.search($(this).val()).draw() ;
        });
        /*-- /. DataTable To Load Data Mahasiswa --*/

      }
      
      /*-- DataTable To Delete Data Mahasiswa --*/
      function deletesls(id_konfirmasi){

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true, 
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({

              url : baseURL+'ajax/deleteSelesai',
              method:"post",
              data:{id_konfirmasi:id_konfirmasi},
              dataType: 'json',

              success:function(data){
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your Data '+data.id_konfirmasi+' has been deleted.',
                  'success'
                  )
                $('#sls_data').DataTable().ajax.reload();
              },

              error:function(data){
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your Data '+data.id_konfirmasi+' has been deleted.',
                  'error'
                  )
                $('#sls_data').DataTable().ajax.reload();
              }
            });

          } 
        })
      };
      /*-- /. DataTable To Delete Data Mahasiswa --*/
    </script>