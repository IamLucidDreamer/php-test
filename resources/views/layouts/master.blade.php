<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="{{asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{asset('public/assets/css/now-ui-dashboard.css?v=1.4.0') }}" rel="stylesheet" />
  <link href="{{asset('public/assets/demo/demo.css') }}" rel="stylesheet" />
   <link rel="stylesheet" href="{{asset('public/admin_assets/css/vertical-layout-light/sweetalert.min.css')}}"> 
   <link rel="stylesheet" href="{{asset('public/assets/css/vertical-layout-light/override.css')}}"> 
</head>

@include("partials.navbar")

@yield('content')

@include("partials.footer")

 <script src="{{asset('public/assets/js/core/jquery.min.js') }}"></script>
  <script src="{{asset('public/assets/js/core/popper.min.js') }}"></script>
  <script src="{{asset('public/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/perfect-scrollbar.jquery.min.js') }} "></script>
  <script src="{{asset('public/assets/js/plugins/moment.min.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/bootstrap-switch.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/sweetalert2.min.js')}}"></script>
  <script src="{{asset('public/assets/js/plugins/jquery.validate.min.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/bootstrap-datetimepicker.js') }}"></script>
  <script src="{{asset('public/ssets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/jasny-bootstrap.min.js')  }}"></script>
  <script src="{{asset('public/assets/js/plugins/fullcalendar.min.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/jquery-jvectormap.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/nouislider.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="{{asset('public/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{asset('public/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <script src="{{asset('public/assets/js/now-ui-dashboard.min.js?v=1.4.0') }}" type="text/javascript"></script>
  <script src="{{asset('public/assets/demo/demo.js') }}"></script>
 

  <script>
    $(document).ready(function() {
      demo.initDashboardPageCharts();
      demo.initVectorMap();
    });
  </script>
 
 @if(Session::has('success'))
  <script type="text/javascript">
     swal({
         title:'Success!',
         text:"{{Session::get('success')}}",
         timer:5000,
         type:'success'
     }).then((value) => {
       //location.reload();
     }).catch(swal.noop);
 </script>
 @endif

 <script>
$(document).ready(function() {
  $("#success").hide();
  $("#success").click(function showAlert() {
    $("#success").fadeTo(2000, 500).slideUp(500, function() {
      $("#success").slideUp(500);
    });
  });
});

</script> 




 <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      demo.initDateTimePicker();
      if ($('.slider').length != 0) {
        demo.initSliders();
      }
    });
  </script>

<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>




</body>
</html>