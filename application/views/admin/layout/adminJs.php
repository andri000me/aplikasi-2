<script type="text/javascript">

 var baseURL= "<?= base_url();?>";

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
})


/*-- DataTable To Load Data Mahasiswa --*/
var mhs = $('#mhs_data').DataTable({

  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseURL+'ajax/get_data_mhs',
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

</script>