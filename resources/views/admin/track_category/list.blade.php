@extends("layouts.master")

@section("title")
All Promo Codes  || Bredge
@endsection

@section("content")

<!-- Main Content area starts -->
    <div class="content">
        <div class="row">

          <div class="col-md-12">
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

            <div class="card">
              <div class="card-header">
                <h4 class="card-title">All Promo Codes</h4>
                 <a href="{{route('admin-create-promo')}} " ><button class="float-right btn btn-info btn-round">Add Promo Code</button></a>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->


                </div>
                
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Promo Name</th>
                      <th>Promo Type</th>
                      <th>Price / Value</th>
                      <th>Start Date</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>Promo Name</th>
                      <th>Promo Type</th>
                      <th>Price / Value</th>
                      <th>Start Date</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>


                    @foreach($promo_code as $value)
                      <tr>
                        <td>{{$value->promo_name}}</td>
                        <td>{{$value->promo_type}}</td>
                        <td>{{$value->price }}</td>
                        <td>{{$value->start_date }}</td>
                        <td>{{$value->expiry_date }}</td>
                        <td>{{$value->status}}</td>

                        <td class="text-right">
                         <a href="{{ route('admin-prmo-edit',$value->id) }}" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                          <a href="{{ route('admin-promo-delete',$value->id) }}" class="btn btn-round btn-danger btn-icon btn-sm"><i class="fas fa-times"></i></a>
                        </td>

                      </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>

<!-- Main content area ends  -->

@endsection


