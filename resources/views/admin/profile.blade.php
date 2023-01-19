@extends("layouts.master")

@section("title")
Profile || Bredge
@endsection

@section("content")
            <div class="content"> 

               <div class="row">

       

                  <div class="col-md-8">

                                @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert" >
                                        {{Session::get('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                @endif

                                @if(Session::has('error'))

                                    <div class="alert alert-danger">

                                       {{Session::get('error')}}

                                    </div>

                                @endif

                     <div class="card ">

                        <div class="card-header ">

                           <!--<h4 class="card-title">Manage Profile

                              </h4>-->

                        </div>

                        <div class="card-body ">

                           <ul class="nav nav-pills nav-pills-primary" role="tablist">

                              <li class="nav-item">

                                 <a class="nav-link active" data-toggle="tab" href="#profile" role="tablist">

                                 Manage Profile

                                 </a>

                              </li>

                              <li class="nav-item">

                                 <a class="nav-link" data-toggle="tab" href="#social" role="tablist">

                                 Social 

                                 </a>

                              </li>

                              <li class="nav-item">

                                 <a class="nav-link" data-toggle="tab" href="#image" role="tablist">

                                 Profile Image

                                 </a>

                              </li>

                              <li class="nav-item">

                                 <a class="nav-link" data-toggle="tab" href="#pass" role="tablist">

                                 Manage Password

                                 </a>

                              </li>

                           </ul>

                           <div class="tab-content tab-space">

                              <div class="tab-pane active" id="profile">

                                 <h4 class="card-title">Manage Profile</h4>

                                 <form class="form-horizontal" method="POST" action="{{route('profile-update',$profile->id)}}">

                                  @csrf

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Name</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" value="{{$profile->name}}" plaeholder="Please enter name" name="name" class="form-control" required>

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Email</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="email" placeholder="Please enter email" value="{{$profile->email}}"  name="email" class="form-control" readonly>

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Contact</label>

                                       <div class="col-md-9">
                                           
                                           
                                           <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text">
                                                        <!--<i class="now-ui-icons users_circle-08"></i>-->
                                                        <strong>+1</strong>
                                                      </div>
                                                </div>
                                             <input type="text" class="form-control"  value="{{$profile->contact}}" placeholder="Please enter contact number"  name="contact" required >
                                          </div>

                                        <!--  <div class="form-group">
                                            <div class="input-group-prepend">
                                    		<div class="input-group-text">
                                    			<i class="now-ui-icons users_circle-08"></i>
                                    		</div>
                                    	</div>
                                             <input type="text" class="form-control"  value="{{$profile->contact}}" placeholder="Please enter contact number"  name="contact" required >

                                          </div>-->

                                       </div>

                                    </div>

                                    <div class="card-footer ">

                                       <div class="row">

                                          <label class="col-md-3"></label>

                                          <div class="col-md-9">

                                             <button type="submit" class="btn btn-fill btn-primary btn-md btn-rounded">Submit</button>

                                          </div>

                                       </div>

                                    </div>

                                 </form>

                              </div>

                              <div class="tab-pane" id="social">

                                 <h5 class="card-title">Manage Social Profile</h5>

                                 <form class="form-horizontal" method="POST" action="{{route('social-profile',$profile->id)}}">

                                  @csrf

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Facebook</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" class="form-control" value="{{$profile->facebook}}"  name="facebook" placeholder="(use https:// befor URL) Ex. https://www.facebook.com/albumer ">

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Twitter</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" class="form-control" value="{{$profile->twitter}}" name="twitter" placeholder="(use https:// befor URL) Ex. https://www.twitter.com/albumer ">

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Linkedin</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" class="form-control" value="{{$profile->linkedin}}" name="linkedin" placeholder="(use https:// befor URL) Ex. https://www.linkedin.com/albumer ">

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Instagram</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" class="form-control" name="instagram" value="{{$profile->instagram}}"  placeholder="(use https:// befor URL) Ex. https://www.instagram.com/albumer ">

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Pinterest</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" class="form-control" name="pinterest" value="{{$profile->pinterest}}" placeholder="(use https:// befor URL) Ex. https://www.pinterest.com/albumer ">

                                          </div>

                                       </div>

                                    </div>

                                    <div class="card-footer ">

                                       <div class="row">

                                          <label class="col-md-3"></label>

                                          <div class="col-md-9">

                                             <button type="submit" class="btn btn-fill btn-primary btn-round btn-md">Update</button>

                                          </div>

                                       </div>

                                    </div>

                                 </form>

                              </div>

                              <div class="tab-pane" id="image">

                                 <h5 class="card-title">Change Profile Image</h5>

                              

                                   <form class="form-horizontal" action="{{route('profile-upload')}}" method="POST" enctype="multipart/form-data">

                                   @csrf

                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">

                                       <div class="fileinput-new thumbnail img-circle33">

                                      @if(Auth::user()->image)

                                         <img class="avatar1 border-gray" src="{{asset('/public/storage/images/'.Auth::user()->image)}}" height="115"  width="115" >

                                      @endif 

                                       </div>

                                       <div class="fileinput-preview fileinput-exists thumbnail img-circle" style=""></div>

                                       <div>

                                          <span class="btn btn-round btn-rose btn-file">

                                          <span class="fileinput-new">Add Photo</span>

                                          <span class="fileinput-exists">Change</span>

                                          <input type="hidden"><input type="file" name="image"></span>

                                          <br>

                                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>

                                       </div>

                                    </div>

                                    <div class="card-footer ">

                                       <div class="row">

                                          <label class="col-md-3"></label>

                                          <div class="col-md-9">

                                             <button type="submit" class="btn btn-fill btn-primary btn-rounded btn-md">Update</button>

                                              <a class="btn btn-rounded btn-md" href="{{route('profile-logo-remove') }}">Remove Logo</a>

                                          </div>

                                       </div>

                                    </div>

                                 </form>

                              </div>

                              <div class="tab-pane" id="pass">

                                 <form class="form-horizontal" method="POST" action="{{route('change-password')}}">
                                  @csrf

                                 <div class="col-md-6">

                                    <h5 class="card-title">Change Password</h5>

                                    <div class="row">

                                       <label class="col-md-4 col-form-label">New Password</label>

                                       <div class="col-md-8">

                                          <div class="form-group">

                                             <input type="text" class="form-control" name="new_password"  placeholder="Enter your new password" required>

                                          </div>

                                       </div>

                                    </div>

                                    <div class="card-footer ">

                                       <div class="row">

                                          <label class="col-md-3"></label>

                                          <div class="col-md-9">

                                             <button type="submit" class="btn btn-fill btn-primary btn-round btn-md">Update</button>

                                          </div>

                                       </div>

                                    </div>

                                 </div>

                                 </form>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="card card-user">

                        <div class="image">

                           <img src="{{asset('public/assets/img/bg5.jpg') }}" alt="...">

                        </div>

                        <div class="card-body">

                           <div class="author">

                              <!-- <a href=":;"> -->

                                  @if(Auth::user()->image)

                                       <img class="avatar border-gray" src="{{asset('/public/storage/images/'.Auth::user()->image)}}" alt="...">

                                  @endif     

                                       <h5 class="title">{{$profile->name}}</h5>



                              <!-- </a> -->

                              <p class="description">

                                 {{$profile->role}}

                              </p>

                           </div>

                           <p class="description text-center">

                              {{$profile->email}}

                              <br> {{$profile->contact}}

                              

                           </p>

                        </div>

                        <hr>

                        <div class="button-container">

                          @if($profile->facebook)

                          <a href="{{$profile->facebook}}" target="_blank"> <button class="btn btn-neutral btn-icon btn-round btn-lg">

                               <i class="fab fa-facebook-square"></i>

                               </button>

                         </a>

                         @endif

                         @if($profile->twitter)

                         <a href="{{$profile->twitter}}" target="_blank">  <button  class="btn btn-neutral btn-icon btn-round btn-lg">

                           <i class="fab fa-twitter"></i>

                           </button> </a>

                         @endif

                        @if($profile->instagram)

                          <a href="{{$profile->instagram}}" target="_blank"> <button  class="btn btn-neutral btn-icon btn-round btn-lg">

                         <i class="fab fa-instagram"></i>

                           </button></a>

                        @endif

                        @if($profile->linkedin)

                         <a href="{{$profile->linkedin}}" target="_blank">  <button  class="btn btn-neutral btn-icon btn-round btn-lg">

                         <i class="fab fa-linkedin"></i>

                           </button></a>

                        @endif

                        @if($profile->pinterest)

                           <a href="{{$profile->pinterest}}" target="_blank">



                           <button   class="btn btn-neutral btn-icon btn-round btn-lg">

                        <i class="fab fa-pinterest"></i>

                           </button>

                         </a>

                         @endif

                        </div>

                     </div>

                  </div>

               </div>
            </div>
	@endsection