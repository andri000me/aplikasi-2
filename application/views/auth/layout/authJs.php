  <script type="text/javascript">
    
   /*-- Toastr  --*/
   toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  <?php if ($this->session->flashdata('success')) {?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php } else if ($this->session->flashdata('error')) {?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php } else if ($this->session->flashdata('warning')) {?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php } else if ($this->session->flashdata('info')) {?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php }?>
  
  /*-- Timeout Alert Error form_validation 5sec --*/
  var timeout = 5000; 
  $('.alert').delay(timeout).fadeOut(500);

  $(document).ready(function(){
    var baseURL= "<?= base_url();?>";
    $('#mhs_form').on('submit', function(event){
      event.preventDefault();
      var nim = $('#nimMhs').val();
      var pass = $('#passMhs').val();
      $.ajax({
        type:'POST',
        url:baseURL+'/auth/mahasiswa',
        data: {nimMhs:nim,passMhs:pass},
        dataType: 'json',
        success: function(data){
          if (data.success == true ){
            if (data.url == true) {
              swal({
                title: data.title,
                text: data.nama,
                timer: 2000,
                type: data.type,
                showConfirmButton: false
              }, function() {
                window.location.href = data.redirect;
              });
            }else{
              swal({
                title: data.title,
                text: data.nama,
                type: data.type
              });
            };
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
        }  
      });
    })
    $('#admin_form').on('submit', function(event){
      event.preventDefault();
      var userAdmin = $('#usrAdmin').val();
      var passAdmin = $('#passAdmin').val();
      $.ajax({
        type:'POST',
        url:baseURL+'auth/admin',    
        data: {usrAdmin:userAdmin,passAdmin:passAdmin},
        dataType: 'json',
        success: function(data){
          if (data.success == true ){
            if (data.url == true) {
              swal({
                title: data.title,
                text: data.nama,
                timer: 2000,
                type: data.type,
                showConfirmButton: false
              }, function() {
                window.location.href = data.redirect;
              });
            }else{
              swal({
                title: data.title,
                text: data.nama,
                timer: 2000,
                type: data.type
              });
            };
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
        }  
      });
    });
  });
</script>