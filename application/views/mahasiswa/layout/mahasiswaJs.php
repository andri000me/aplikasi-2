<script type="text/javascript">

 var baseURL= "<?= base_url();?>";
   var nim = "<?= $user->nim?>" ;

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


$(function () {
  'use strict'
  
  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
  $('.connectedSortable .card-header').css('cursor', 'move')

  /*-- Select 2 --*/
  $('.select2').select2()

  /*-- Timeout Alert Error form_validation 5sec --*/
  var timeout = 5000; 
  $('.alert').delay(timeout).fadeOut(500);

  /*-- Plugin for edit data mahasiswa --*/
  $('[data-mask]').inputmask();

  var table = $('#example').DataTable( {
    "sDom": 'lrtip',
    "lengthChange": false,
    "rowReorder": {
      "selector": 'td:nth-child(0)'
    },
    "responsive": true,
  });
  $('#seachExample').keyup(function(){
    table.search($(this).val()).draw() ;
  });
})

/*-- Costum Sweetalert2 --*/
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  }
})
/*-- /. Costum Sweetalert2 --*/

$(document).ready(function(){

  function load_unseen_notification(view = ''){
    $.ajax({
     url:baseURL+'mahasiswa/getNotif',
     method:"POST",
     data:{view:view},
     dataType:"json",
     success:function(data){
      $('.dropdown-menu').html(data.notification);
      if(data.unseen_notification > 0){
       $('.count').html(data.unseen_notification);
     }
   }
 });
  }

  load_unseen_notification();

  $(document).on('click', '#notif', function(){
      // var nimNo = nim;
      $.ajax({
        url:baseURL+'mahasiswa/updateNotif',
        method:"POST",
        data:{nim:nim},
        dataType:"json",
        success:function(data){
          $('.count').html('');
        }
      })
    });

  setInterval(function(){ 
    load_unseen_notification();; 
  }, 5000);

});

</script>