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
                <div class="form-group">
                  <label class="col-form-label" for="inputWarning">Enkripsi</label>
                  <textarea class="form-control" name="kode" readonly id="kode" placeholder="enkripsi"></textarea>
                </div>
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

      <script type="text/javascript">

        window.onload = function () {

          function docReady(fn) {
            /*-- see if DOM is already available  --*/
            if (document.readyState === "complete"
              || document.readyState === "interactive") {
              /*-- call on next available tick  --*/
            setTimeout(fn, 1);
          } else {
            document.addEventListener("DOMContentLoaded", fn);
          }
        }

        docReady(function () {
          var resultContainer = document.getElementById('qr_reader_results');
          var lastResult, countResults = 0;
          function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
              ++countResults;
              lastResult = qrCodeMessage;
              resultContainer.innerHTML
              += `${qrCodeMessage}`;
            }
          }

          var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
          html5QrcodeScanner.render(onScanSuccess);
        });

        $('#searchen').on('click', function(e){
          e.preventDefault();
          var kode = $('#qr_reader_results').val();
          var website = baseURL;

          Swal.fire({
            title: 'Loading...',
            html: 'Please wait Search Chipertext',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading()
              $.ajax({
                url : baseURL+'ajax/searchEn',
                method :'post',
                data:'kode='+kode+'&website=' +website,
                dataType:'json',
                success:function(data){
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Chipertext Found!'
                  })
                  $('#kode').val(data.enkripsikode);
                  $('#n').val(data.enkripsikodeN);
                  $('#d').val(data.enkripsikodeD);
                },
                error:function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Chipertext Not Found!'
                  })
                }
              });
            }
          })
        });


        $('#dekripsi').click(function(){
          var kode = $('#kode').val();
          var n = $('#n').val();
          var d = $('#d').val();

          Swal.fire({
            title: 'Loading...',
            html: 'Please wait Search Chipertext',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading()
              $.ajax({
                url : baseURL+'ajax/getDekripsi',
                method :'post',
                data:'kode='+ kode +'&n='+ n +'&d=' +d,
                dataType:'json',
                success:function(data){
                  if(data.success == true){
                    Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Chipertext Berhasil di Dekripsi!'
                    })
                    $('#hasildekripsi').val(data.dekripsi[1]);
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
                },
                error:function(data){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Chipertext Gagal di Dekripsi!'
                  })
                }
              });
            }
          })
        })


      }
    </script>