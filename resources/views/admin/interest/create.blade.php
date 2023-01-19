@extends("layouts.master")
@section("title")
Create Interest || Bredge
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
                     <h4 class="card-title">Create Interests</h4>
                     <form class="form-horizontal" method="POST" action="{{route('admin-store-interest')}}">
                        @csrf
                        <div class="row">
                           <label class="col-md-3 col-form-label">Interest Name</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text" value="" placeholder="Please enter Interest name" name="name" class="form-control" required="">
                           @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                              @endif
                              </div>
                            
                           </div>
                        </div>
                        
                       
                       
                        <div class="row">
                           <label class="col-md-3 col-form-label">Status</label>
                           <div class="col-md-9">
                              <div class="form-group">

                                 <select class="form-control" name="status" data-size="" data-style="" title="Select Status">
                                       <option value="Active">Active</option>
                                       <option value="Inactive">Inactive</option>
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