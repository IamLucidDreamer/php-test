@extends("layouts.master")

@section("title")
Create Levels || Bredge
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

                                 <h4 class="card-title">Manage Level</h4>

                                 <form class="form-horizontal" method="POST" action="{{route('admin-level-store') }}">

                                  @csrf

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Select Challenge</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <select class="form-control" name="challenge_id" data-size="" data-style="" title="Select Challenge">
                                                <option>Select Challenge</option>
                                                   @foreach($challenge as $value)
                                                      <option value="{{$value->id}}"> {{$value->challenge_name}}</option>

                                                   @endforeach
                                             </select>

                                          </div>

                                       </div>

                                    </div>

                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Level Name</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <input type="text" value="" placeholder="Please enter name" name="level_name" class="form-control" required>

                                          </div>

                                       </div>

                                    </div>

                                    

                                     <div class="row">

                                       <label class="col-md-3 col-form-label">Reward Points</label>

                                       <div class="col-md-9">

                                          <div class="form-group">
                                                <small class="text-danger">* Enter only numeric values.</small>
                                             <input type="text" value="" placeholder="Please enter reward points" name="reward_points" class="form-control" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                          </div>

                                       </div>

                                    </div>

                                     <div class="row">

                                       <label class="col-md-3 col-form-label">Level Description</label>

                                       <div class="col-md-9">

                                          <div class="form-group ">

                                           <textarea name="level_description" class="form-control"></textarea>

                                          </div>

                                       </div>

                                    </div>
                                    <div class="row">

                                       <label class="col-md-3 col-form-label">Status</label>

                                       <div class="col-md-9">

                                          <div class="form-group">

                                             <select class="form-control" name="" data-size="" data-style="" title="Select Status">
                                                   <option value="Active">Active</option>
                                                   <option value="Inactive">Inactive</option>
                                               </select>

                                          </div>

                                       </div>

                                    </div>
                                   <!--  <div class="row">
                                        <div class="customer_records">
                                            <div class="row">
                                            <label class="col-md-4 col-form-label">Status</label>
                                            <div class="col-md-2"><input name="customer_name" class="form-control" type="text" value="name">
                                            </div>
                                            <div class="col-md-2"><input name="customer_age" class="form-control" type="number" value="age">
                                            </div>
                                            <div class="col-md-2">
                                              <input name="customer_email" class="form-control" type="email" value="email">
                                            </div>
                                            <div class="col-md-2">
                                            <a class="extra-fields-customer" href="#"> Add More Customer</a>
                                            </div>
                                            
                                          </div>
                                        </div>

                                          <div class="customer_records_dynamic"></div>

                                      </div> -->

                                      <!--<div class="row">
                                        <label class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                           <div class="form-group">
                                              <select class="selectpicker" name="status" data-size="7" data-style="" title="Select Status">
                                                 <option value="Active">Active</option>
                                                 <option value="Inactive">Inactive</option>
                                              </select>
                                           </div>
                                           @if ($errors->has('status'))
                                           <span class="text-danger">{{ $errors->first('status') }}</span>
                                           @endif
                                      </div>-->
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
            <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
             <script type="text/javascript">
               $('.extra-fields-customer').click(function() {
              $('.customer_records').clone().appendTo('.customer_records_dynamic');
              $('.customer_records_dynamic .customer_records').addClass('single remove');
              $('.single .extra-fields-customer').remove();
              $('.single').append('<div class="col-md-2 remove-field btn-remove-customer"><a href="#" class="">Remove Fields</a></div>');
              $('.customer_records_dynamic > .single').attr("class", "remove");

              $('.customer_records_dynamic input').each(function() {
                var count = 0;
                var fieldname = $(this).attr("name");
                $(this).attr('name', fieldname + count);
                count++;
              });

            });

            $(document).on('click', '.remove-field', function(e) {
              $(this).parent('.remove').remove();
              e.preventDefault();
            });
             </script>
@endsection