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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dProdi')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dProdiDetail/'.$this->encrypt->encode($onepro->kdpro))?>"><small><?= $page ?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->            
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title"><?php echo $page; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dProdiAdd')?>" method="post">
            <div class="card-body ml-3 mr-3">
              <div class="form-group row">
                <label for="detailProdiKode" class="col-sm-2 col-form-label">Kode Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kdpro" class="form-control" id="detailProdiKode" placeholder="Kode Prodi" value="<?= $onepro->kdpro ;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailProdiNama" class="col-sm-2 col-form-label">Nama Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="nmpro" class="form-control" id="detailProdiNama" placeholder="Nama Prodi" value="<?= $onepro->prodi ;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailProdiJenjang" class="col-sm-2 col-form-label">Jenjang Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="jenpro" class="form-control" id="detailProdiJenjang" placeholder="Jenjang Prodi" value="<?= $onepro->jen;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailProdiKaprodi" class="col-sm-2 col-form-label">Nama Kaprodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kapro" class="form-control" id="detailProdiKaprodi" placeholder="Nama Kaprodi" value="<?= $onepro->kaprodi ;?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="detailProdikdmk" class="col-sm-2 col-form-label">Kode MK Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kdmkpro" class="form-control" id="detailProdikdmk" placeholder="Kode MK Prodi" value="<?= $onepro->kdmk ;?>" readonly>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/dProdi');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <a class="btn btn-warning btn-sm float-right" href="<?= base_url('admin/dProdiEdit/'.$this->encrypt->encode($onepro->kdpro).'')?>"><i class="fas fa-user-edit"></i>&ensp;Edit</a>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
