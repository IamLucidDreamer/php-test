@extends("layouts.master")
@section("title")
Edit Challenge || Bredge
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
                     <h4 class="card-title">Edit Challenge</h4>
                  <form class="form-horizontal" method="POST" action="{{route('admin-update-challenge',$challenge->id)}}">
                        @csrf
                        <div class="row">
                           <label class="col-md-3 col-form-label">Challenge Name</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text" value="{{$challenge->challenge_name}}" name="challenge_name" class="form-control" required="">
                              </div>
                              @if ($errors->has('challenge_name'))
                              <span class="text-danger">{{ $errors->first('challenge_name') }}</span>
                              @endif
                           </div>
                        </div>

                         <div class="row">

                                       <label class="col-md-3 col-form-label">Expiry Date</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text"  placeholder="Please enter name" name="expiry_date" class="form-control" value="{{$challenge->expiry_date}}">

                                             @if ($errors->has('expiry_date'))
                                                <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                                             @endif

                                          </div>

                                       </div>

                                    </div>
                       
                       
                       
                        <div class="row">
                           <label class="col-md-3 col-form-label">Status</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <select class="selectpicker" name="status" data-size="7" data-style="btn btn-light btn-round" title="Select Status">

                                 <option value="Active" {{$challenge->status == 'Active'  ? 'selected' : ''}}> Active  </option>
                                 <option value="Inactive" {{$challenge->status == 'Inactive'  ? 'selected' : ''}}>Inactive</option>

                                    <!-- <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option> -->

                                 </select>
                              </div>
                              @if ($errors->has('status'))
                              <span class="text-danger">{{ $errors->first('status') }}</span>
                              @endif
                           </div>
                        </div>
                       
                        <div class="card-footer ">
                           <div class="row">
                              <label class="col-md-3"></label>
                              <div class="col-md-9">
                                 <button type="submit" class="btn btn-fill btn-primary btn-md btn-rounded">Update</button>
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