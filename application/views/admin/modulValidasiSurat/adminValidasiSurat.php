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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sValidasiSurat')?>"><small><?= $page ;?></small></a></li>
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
          <div class="card-body">
            <div id="erroren"></div>
            <div class="row">
              <div class="col-6">
                <div id="qr-reader" style="width:500px"></div>
                <!--                 <div id="qr-reader-results"></div> -->
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="target" class="col-form-label">Enkripsi</label>
                  <textarea class="form-control" name="no_surat" id="qr_reader_results" placeholder="Enkripsi" rows="5" value="" readonly></textarea>
                </div>
                <button class="btn btn-primary btn-sm float-sm-right" id="searchen"><i class="fa fa-search"></i>&ensp;Search</button>

                <input type="hidden"  name="kode" readonly id="kode" class="form-control" placeholder="n (desimal)">

                <div class="form-group">
                  <label class="col-form-label" for="inputWarning">n (desimal)</label>
                  <input type="text"  name="n" readonly id="n" class="form-control" placeholder="n (desimal)">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputWarning2">d (desimal)</label>
                  <input type="text"  name="n" readonly id="d" class="form-control" placeholder="d (desimal)">
                </div>
                <button class="btn btn-warning btn-sm " id="dekripsi"><i class="fa fa-lock-open"></i>&ensp;Dekripsi</button>
                <div class="form-group">
                  <label for="target" class="col-form-label">Hasil Dekripsi</label>
                  <textarea class="form-control" readonly name="no_surat" id="hasildekripsi" placeholder="Dekripsi" rows="5" value=""></textarea>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.container-fluid -->

      </section>
      <!-- /.content -->