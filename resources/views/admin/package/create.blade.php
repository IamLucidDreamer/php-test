@extends("layouts.master")

@section("title")
Create Package || Bredge
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


                           <div class="tab-content tab-space">

                              <div class="tab-pane active" id="profile">

                                 <h4 class="card-title">Manage Package</h4>

                                 <form class="form-horizontal" method="POST" action="{{route('admin-create-package')}}">

                                  @csrf

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Package Name</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" value="" placeholder="Please enter name" name="package_name" class="form-control" required>

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Price</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" placeholder="Please enter price" value=""  name="price" class="form-control" required="" >

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Features</label>

                                       <div class="col-md-9">
                                           
                                           
                                           <div class="form-group">
                                               
                                             <textarea class="form-control" name="features" placeholder="Enter package features by comma seprated" rows="15" required="">
                                               


                                             </textarea>
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

                           </div>

                        </div>

                     </div>

                  </div>        
               </div>
            </div>         

@endsection