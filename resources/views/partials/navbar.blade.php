<body class=" sidebar-mini ">
  <div class="wrapper ">
    <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
 -->
      <div class="logo">           
        <div  class="simple-text logo-normal">
          CyclerTrek
        </div> 
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
            <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
            <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
          </button>
        </div>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <div class="user">
          <div class="photo">
              @if(Auth::user()->image)
                  <img class="avatar border-gray" src="{{asset('/public/storage/images/'.Auth::user()->image)}}" alt="...">
              @endif   
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                 <a href="{{route('admin.dashboard') }}">Dashboard</a>
             <!--  @php   
                  echo Auth::user()->name;
              @endphp -->
               <!--  <b class="caret"></b> -->
              </span>
            </a>
            <div class="clearfix"></div>
           <!--  <div class="collapse" id="collapseExample">
              <ul class="nav">             
                <li>
                  <a href="{{route('admin.profile') }}">
                    <span class="sidebar-mini-icon">EP</span>
                    <span class="sidebar-normal">Edit Profile</span>
                  </a>
                </li>
              <li>
                  <a href="#">
                    <span class="sidebar-mini-icon">S</span>
                    <span class="sidebar-normal">Settings</span>
                  </a>
                </li>
              </ul>
            </div> -->
          </div>
        </div>
        <ul class="nav">

          <!--   <li class="active">
              <a href="{{route('admin.dashboard') }}">
                <i class="now-ui-icons design_app"></i>
                <p>Dashboard</p>
              </a>
            </li>   -->

          <li>
            <a data-toggle="collapse" href="#subscriptions">
              <i class="now-ui-icons education_paper"></i>
              <p>
                Manage Profile
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="subscriptions">
              <ul class="nav">
                <li>
                  <a href="{{route('admin.profile') }}">
                    <span class="sidebar-mini-icon">EP</span>
                    <span class="sidebar-normal">Edit Profile</span>
                  </a>
                </li>

            <!--   <li>
                  <a href="#">
                    <span class="sidebar-mini-icon">S</span>
                    <span class="sidebar-normal">Settings</span>
                  </a>
                </li> -->
              </ul>
            </div>
          </li>




            <li class="">
              <a href="{{route('admin.users') }}">
                <i class="now-ui-icons emoticons_satisfied"></i>
                <p>All Users</p>
              </a>
            </li>  

          <li>
            <a data-toggle="collapse" href="#subscriptions">
              <i class="now-ui-icons education_paper"></i>
              <p>
                Subscription
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="subscriptions">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-create-package') }}">
                    <span class="sidebar-mini-icon">CS</span>
                    <span class="sidebar-normal"> Create Subscription </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-package') }}">
                    <span class="sidebar-mini-icon">LS</span>
                    <span class="sidebar-normal">  Subscription List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#promo">
              <i class="now-ui-icons business_money-coins"></i>
              <p>
                Promo Code 
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="promo">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-create-promo') }}">
                    <span class="sidebar-mini-icon">PC</span>
                    <span class="sidebar-normal"> Add Promo Code </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-promo-codes') }}">
                    <span class="sidebar-mini-icon">LS</span>
                    <span class="sidebar-normal">  Promo Codes List</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

        

          <li>
            <a data-toggle="collapse" href="#intr">
              <i class="now-ui-icons travel_info"></i>
              <p>
                Manage Interest 
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="intr">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-interest-create') }}">
                    <span class="sidebar-mini-icon">AI</span>
                    <span class="sidebar-normal"> Add Interest </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-interest-list') }}">
                    <span class="sidebar-mini-icon">LI</span>
                    <span class="sidebar-normal">  Interest List</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>


           <li>
            <a data-toggle="collapse" href="#challenge">
              <i class="now-ui-icons sport_trophy"></i>
              <p>
                Manage Challnge 
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="challenge">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-create-challenge')}}">
                    <span class="sidebar-mini-icon">AC</span>
                    <span class="sidebar-normal"> Add Challenge </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-challenge-list') }}">
                    <span class="sidebar-mini-icon">LC</span>
                    <span class="sidebar-normal">  Challange List</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#level">
              <i class="now-ui-icons objects_key-25"></i>
              <p>
                Manage Levels 
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="level">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-level-create') }}">
                    <span class="sidebar-mini-icon">AL</span>
                    <span class="sidebar-normal"> Add Level </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-level-list') }}">
                    <span class="sidebar-mini-icon">LL</span>
                    <span class="sidebar-normal">  Level List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#tracc">
              <i class="now-ui-icons travel_info"></i>
              <p>
                Track Categories 
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="tracc">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-track-create') }}">
                    <span class="sidebar-mini-icon">TC</span>
                    <span class="sidebar-normal"> Add Track category </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-interest-list') }}">
                    <span class="sidebar-mini-icon">LI</span>
                    <span class="sidebar-normal"> Track Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

            <li>
            <a data-toggle="collapse" href="#faq">
              <i class="now-ui-icons business_badge"></i>
              <p>
                Manage FAQ's 
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="faq">
              <ul class="nav">
                <li>
                  <a href="{{route('admin-create-faq') }}">
                    <span class="sidebar-mini-icon">AF</span>
                    <span class="sidebar-normal"> Add FAQ </span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin-list-faq') }}">
                    <span class="sidebar-mini-icon">LF</span>
                    <span class="sidebar-normal">  FAQ's List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
           
           
        </ul>




      </div>
    </div>

      <div class="main-panel" id="main-panel">

            <!-- Navbar -->

            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">

               <div class="container-fluid">

                  <div class="navbar-wrapper">

                     <div class="navbar-toggle">

                        <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>

                        <span class="navbar-toggler-bar bar2"></span>

                        <span class="navbar-toggler-bar bar3"></span>

                        </button>

                     </div>

                    

                  </div>

                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">

                  <span class="navbar-toggler-bar navbar-kebab"></span>

                  <span class="navbar-toggler-bar navbar-kebab"></span>

                  <span class="navbar-toggler-bar navbar-kebab"></span>

                  </button>

                  <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <!--  <form>

                        <div class="input-group no-border">

                           <input type="text" value="" class="form-control" placeholder="Search...">

                           <div class="input-group-append">

                              <div class="input-group-text">

                                 <i class="now-ui-icons ui-1_zoom-bold"></i>

                              </div>

                           </div>

                        </div>

                     </form> -->

                     <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="now-ui-icons location_world"></i>

                              <p>

                                 <span class="d-lg-none d-md-block">Some Actions</span>

                              </p>

                           </a>

                           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                  <a class="dropdown-item" href="{{route('admin.logout') }}">Logout</a>

                  

                </div>

                        </li>
                     </ul>
                  </div>
               </div>
            </nav>

            <!-- End Navbar -->

            <div class="panel-header panel-header-sm">
            </div>

<!-- Header part ends here -->