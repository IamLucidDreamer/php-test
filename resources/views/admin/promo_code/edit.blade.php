@extends("layouts.master")
@section("title")
Create Promo Code || Bredge
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
                     <h4 class="card-title">Edit Promo Code</h4>
                     <form class="form-horizontal" method="POST" action="{{route('admin-update-promo',$promo->id)}}">
                        @csrf
                        <div class="row">
                           <label class="col-md-3 col-form-label">Promo Code Name</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text" value="{{$promo->promo_name}}" name="promo_name" class="form-control" required="">
                              </div>
                              @if ($errors->has('promo_name'))
                              <span class="text-danger">{{ $errors->first('promo_name') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="row">
                           <label class="col-md-3 col-form-label">Promo Type</label>
                           <div class="form-group">
                              <div class="col-md-9">
                                 <div class="form-check form-check-inline form-check-radio">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="promo_type"  value="fixed" {{ ($promo->promo_type=="fixed")? "checked" : "" }}>
                                    <span class="form-check-sign"></span>
                                    By Fixed Price
                                    </label>
                                 </div>
                                 <div class="form-check form-check-inline form-check-radio">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="promo_type"  value="percentage" {{ ($promo->promo_type=="percentage")? "checked" : "" }}>
                                    <span class="form-check-sign"></span>
                                    By Percentage
                                    </label>
                                 </div>
                              </div>
                              @if ($errors->has('promo_type'))
                              <span class="text-danger">{{ $errors->first('promo_type') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="row">
                           <label class="col-md-3 col-form-label">Price</label>
                           <div class="col-md-9">
                              <div class="form-group">
                                 <input type="text"  value="{{$promo->price}}"  name="price" class="form-control" required="" >
                              </div>
                              @if ($errors->has('price'))
                              <span class="text-danger">{{ $errors->first('price') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label class="col-md-3 col-form-label"> Start Date</label>
                              <div class="col-md-9">
                                 <div class="form-group">
                                    <input type="text" class="form-control datepicker" value="{{$promo->start_date}}" name="start_date" placeholder="Choose promo start date">
                                 </div>
                                 @if ($errors->has('start_date'))
                                 <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                 @endif
                              </div>
                           </div>
                           <div class="col-md-6">
                              <label class="col-md-3 col-form-label"> Expiry Date</label>
                              <div class="col-md-9">
                                 <div class="form-group">
                                    <input type="text" name="expiry_date" class="form-control datepicker" value="{{$promo->expiry_date}}">
                                 </div>
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

                                 <option value="Active" {{$promo->status == 'Active'  ? 'selected' : ''}}> Active  </option>
                                 <option value="Inactive" {{$promo->status == 'Inactive'  ? 'selected' : ''}}>Inactive</option>

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