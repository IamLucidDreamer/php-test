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
                  <form class="form-horizontal" method="POST" action="{{route('admin-update-level',$level->id)}}">
                        @csrf
                        <div class="row">
                           <label class="col-md-3 col-form-label">Challenge Name</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                <select class="form-control" name="challenge_id" data-size="" data-style="" title="Select Challenge">
                                 <option>Select Challenge</option>
                                     @foreach($challenge as $value)
                                       <option value="{{ $value->id }}" {{$value->id == $level->challenge_id  ? 'selected' : ''}}>{{ $value->challenge_name}}</option>
                                     @endforeach
                                 </select>

                              </div>
                              @if ($errors->has('challenge_name'))
                              <span class="text-danger">{{ $errors->first('challenge_name') }}</span>
                              @endif
                           </div>
                        </div>

                         <div class="row">
                           <label class="col-md-3 col-form-label">Level Name</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text" value="{{$level->level_name}}" name="level_name" class="form-control" required="">
                              </div>
                              @if ($errors->has('level_name'))
                              <span class="text-danger">{{ $errors->first('level_name') }}</span>
                              @endif
                           </div>
                        </div>


                          <div class="row">

                              <label class="col-md-3 col-form-label">Reward Points</label>

                              <div class="col-md-9">

                                 <div class="form-group">
                                       <small class="text-danger">* Enter only numeric values.</small>
                                    <input type="text" value="{{$level->reward_points}}" placeholder="Please enter reward points" name="reward_points" class="form-control" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                 </div>

                              </div>

                           </div>

                            <div class="row">

                                       <label class="col-md-3 col-form-label">Level Description</label>

                                       <div class="col-md-9">

                                          <div class="form-group ">

                                           <textarea name="level_description" class="form-control">{{$level->level_description}}</textarea>

                                          </div>

                                       </div>

                                    </div>
                       
                       
                       
                        <div class="row">
                           <label class="col-md-3 col-form-label">Status</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <select class="selectpicker" name="status" data-size="7" data-style="btn btn-light btn-round" title="Select Status">
                                    <option value="Active" {{$level->status == 'Active'  ? 'selected' : ''}}> Active  </option>
                                    <option value="Inactive" {{$level->status == 'Inactive'  ? 'selected' : ''}}>Inactive</option>
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