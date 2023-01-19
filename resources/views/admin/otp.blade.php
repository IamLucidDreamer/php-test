<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Enter OTP  | Cycler Trek</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('public/admin_assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/vendors/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="css/vertical-layout-light/font-awesome.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body class="sidebar-dark">


  @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif


@if(Session::has('fail'))
    <div class="alert alert-danger">
       {{Session::get('fail')}}
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-danger">
       {{Session::get('warning')}}
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-danger">
       {{Session::get('info')}}
    </div>
@endif
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg" style="background-color: #657d89;">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center login-half-bg_left" >

              @if(Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error') }}
                </div> 

              @endif 
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
               <img src="{{asset('public/admin_assets/images/cycle.png')}}" alt="logo"/>
              </div>
               <p class="">We sent code to email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p>

               <h4>Verify Your Identity</h4> 
              <h6 class="font-weight-light"> 
              </h6>

              <form class="pt-3" method ="POST" action="{{route('otp-verify')}}">
                @csrf
                <div class="form-group">
                 <!--  <label for="otp"> OTP </label> -->
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock" aria-hidden="true"></i>

                      </span>
                    </div>
                    <input type="text" class="text-white form-control form-control-lg border-left-0" name="otp" placeholder="Enter Your OTP">
                    @if ($errors->has('otp'))
                       <span class="text-danger">{{ $errors->first('otp') }}</span>
                    @endif

                  </div>
                </div>
                              
                <div class="my-3">
                  <button type ="submit" class="btn btn-block bg-white btn-lg font-weight-bold auth-form-btn">Verify</button>
                </div>
                
                  <a class="btn btn-info" href="{{route('otp-resend') }}">Resend OTP ?</a>

              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?php echo date('Y'); ?>  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
 <script src="{{asset('public/admin_assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('public/admin_assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/admin_assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset ('public/admin_assets/js/template.js')}}"></script>
  <script src="{{asset('public/admin_assets/js/template.js')}}"></script>
  <script src="{{asset('public/admin_assets/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

</html>
