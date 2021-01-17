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

CKEDITOR.replace( 'editor2', {
  filebrowserBrowseUrl: baseURL+'assets/ckfinder/ckfinder.html',
  filebrowserUploadUrl: baseURL+'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
  contentsCss : baseURL+'/assets/ckeditor_4.15.1_full/mystyles.css',
} );

/*-- Change Name Image on Update Profile --*/
$('.custom-file-input').on('change', function(){
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
})
/*-- /. Change Name Image on Update Profile --*/

/*-- Costum Sweetalert2 --*/
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  }
})
/*-- /. Costum Sweetalert2 --*/

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

/*-- DataTable To Delete Data Mahasiswa --*/
function deletemhs(nim){

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

        url : baseURL+'ajax/dMahasiswaDelete',
        method:"post",
        data:{nim:nim},
        dataType: 'json',

        success:function(data){
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your Data '+data.nim+' has been deleted.',
            'success'
            )
          $('#mhs_data').DataTable().ajax.reload();
        },

        error:function(data){
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your Data '+data.nim+' has been deleted.',
            'error'
            )
          $('#mhs_data').DataTable().ajax.reload();
        }
      });

    } 
  })
};
/*-- /. DataTable To Delete Data Mahasiswa --*/
</script>