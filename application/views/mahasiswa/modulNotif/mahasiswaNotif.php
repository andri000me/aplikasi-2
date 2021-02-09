    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $page?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Esurat</small></li>
              <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/notif')?>"><small><?= $page ;?></small></a></li>
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
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
            <div class="card-tools">
              <!-- button with a dropdown -->
              <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">

            <div class="timeline timeline-inverse ml-2">
              <?php if($allnotif == NULL) : ?>

                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-primary">
                    <?= date('d M Y')?>
                  </span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="far fa-clock bg-gray"></i>

                  <div class="timeline-item">

                    <h3 class="timeline-header">No Notifation Found</h3>
                  </div>
                </div>
                <!-- END timeline item -->

                <?php else :?>

                  <?php foreach($allnotif as $row) : ?>

                    <?php if($row->comment_surat == 'Y') : ?>

                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-gray">
                          <?= date('d M Y', strtotime($row->comment_date))?>
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-success"></i>

                        <div class="timeline-item">
                          <span class="time"><a href="#" data-toggle="modal" data-target="#notifDelete<?= $row->comment_id?>"><i class="fas fa-times"></i></a></span>

                          <h3 class="timeline-header">
                            <text class="text-primary"><b>Administrator</b></text> menyetujui permintaan surat

                          </h3>

                          <div class="timeline-body">
                            <?= $row->comment_text;?>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->

                      <?php else :?>

                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-gray">
                            <?= date('d M Y', strtotime($row->comment_date))?>
                          </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-envelope bg-danger"></i>

                          <div class="timeline-item">
                            <span class="time"><a href="#" data-toggle="modal" data-target="#notifDelete<?= $row->comment_id?>"><i class="fas fa-times"></i></a></span>

                            <h3 class="timeline-header"><text class="text-primary"><b>Administrator</b></text> menolak permintaansurat</h3>

                            <div class="timeline-body">
                              <?= $row->comment_detail;?>
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->

                      <?php endif;?>

                    <?php endforeach;?>

                  <?php endif;?>

                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer justify-content-between">
                <a class="btn btn-secondary btn-sm" href="<?= base_url('mahasiswa');?>">
                  <i class="fas fa-arrow-left"></i>&ensp;Back 
                </a>
              </div>

            </div>
            <!-- /.card -->
          </div>
          <!-- /.container-fluid -->

          <!-- Role Hapus Modal-->
          <?php $i=0; foreach($allnotif as $notif) : $i++; ?>
          <div class="modal fade" id="notifDelete<?= $notif->comment_id ;?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header card-outline card-danger">
                  <h5 class="modal-title">Delete Notif </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Pilih "Delete" dibawah untuk menghapus Notif.</p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
                  <a class="btn btn-danger btn-sm" href="<?= base_url('mahasiswa/deleteNotif/').$this->encrypt->encode($notif->comment_id).'';?>"><i class="fas fa-trash"></i>&ensp;Delete</a>
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