<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'DAFTAR DATA RUMAH IBADAH - Wilayah Kabupaten Tangerang
') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.1/sweetalert2.min.css" integrity="sha512-OkYLbkJ4DB7ewvcpNLF9DSFmhdmxFXQ1Cs+XyjMsMMC94LynFJaA9cPXOokugkmZo6O6lwZg+V5dwQMH4S5/3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->

 
    <script src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://nightly.datatables.net/buttons/js/buttons.html5.min.js"></script>
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- CSS SELECT2 -->
  

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 

  

  
</head>
<!-- INI BAWAAN TEMPLATE -->
<!-- <body class="hold-transition sidebar-mini"> -->

<body class="hold-transition sidebar-collapse layout-top-nav">

<div class="wrapper">

    <!-- NAVBAR ATAS  -->
    @include('layout.navbar.main-nav')

    
    
    <!-- LOAD CONTENT -->
    @yield('content')

    
    
    <!-- FOOTER  -->
    @include('layout.footer.footer')


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.1/sweetalert2.all.min.js



"></script>

<!-- Page specific script -->
<script>

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "lengthMenu": [[5, 10, 25, 50, -1], [5,10, 25, 50, "All"]],
      "messageTop" : 'DATA TEMPAT IBADAH KABUPATEN TANGGERANG',
      

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
    $(window).on("load",function(){ 
  
  //Fade Out
  //$(".loader").delay(1500).fadeOut(500);
  
  //Slide Left
  $(".loader").delay(1500).animate({width:'toggle'},2000);
  
});
</script>
<script type="text/javascript">
         $(document).ready(function() {
              // Province change

              $('#province').change(function(){

                  // Province id
                  var id =  $(this).val();
                  var province_id =  $(this).val();
                  var base_url = '{{ url("/getCitys") }}';
                  if (province_id.value !== '') {
                    ajaxUrl = base_url.replace('-1',province_id.value);
                  }
                  console.log(id);
                  console.log(province_id);

                  // Empty DropDown
                  $('#city').find('option').not(':first').remove();

                  // AJAX Request
                  $.ajax({
                      url: ajaxUrl + '/' + province_id,
                      type: 'GET',
                      dataType: 'json',
                      success : function(response){

                          console.log(province_id);
                          var len = 0;
                          if(response != null){
                              len = response.length;
                          }

                          if(len > 0) {

                              // Read Data Create Option
                              for(var i=0; i<len; i++) {
                                  var province_id = response[i].province_id;
                                  var name = response[i].name;
                                  var city_id = response[i].id;
                                  var option = "<option value='"+city_id+"'>"+name+"</option>";

                              $("#city").append(option);
                              }
                          }
                      }
                  })


              })

              $('#city').change(function(){
                  var city_id =  $(this).val();

                  $('#district').find('option').not(':first').remove();
                  var base_url = '{{ url("/getDistrict") }}';
                  if (city_id.value !== '') {
                    ajaxUrl = base_url.replace('-1',city_id.value);
                  }
                  // AJAX Request
                  $.ajax({
                      url: ajaxUrl + '/' + city_id,
                      type: 'GET',
                      dataType: 'json',
                      success : function(res){
                        console.log(city_id);

                          var len = 0;
                          if(res != null){
                              len = res.data.length;
                          }

                          if(len > 0) {
                              // Read Data Create Option
                              for(var i=0; i<len; i++) {
                                  var city_id = res.data[i].city_id;
                                  var name = res.data[i].name;
                                  var district_id = res.data[i].id;
                                  var option = "<option value='"+district_id+"'>"+name+"</option>";

                              $("#district").append(option);
                              }
                          }
                      }
                  })

              })

              $('#district').change(function(){
                  var district_id =  $(this).val();
                  var base_url = '{{ url("/getVillages/") }}';
                  if (district_id.value !== '') {
                    ajaxUrl = base_url.replace('-1',district_id.value);
                  }
                  
                  $('#villages').find('option').not(':first').remove();
                 
                  console.log(district_id);
                  // AJAX Request
                  $.ajax({
                      url: ajaxUrl + '/' + district_id,
                      type: 'GET',
                      dataType: 'json',
                      success : function(res){
                        

                          var len = 0;
                          if(res != null){
                              len = res.data.length;
                          }

                          if(len > 0) {
                              // Read Data Create Option
                              for(var i=0; i<len; i++) {
                                  var district_id = res.data[i].city_id;
                                  var name = res.data[i].name;
                                  var villages_id = res.data[i].id;
                                  var option = "<option value='"+villages_id+"'>"+name+"</option>";

                              $("#villages").append(option);
                              }
                          }
                      }
                  })

              })
         })
     </script>
    <script>
        $(document).ready( function () {
    var table = $('#example1').dataTable();
    var tableTools = new $.fn.dataTable.TableTools( table, {
        "buttons": [
            "copy",
            "csv",
            "xls",
            "pdf",
            { "type": "print", "buttonText": "Print me!" }
        ]
    } );
      
    $( tableTools.fnContainer() ).insertAfter('div.card-title');
} );
    </script>



</body>
</html>
