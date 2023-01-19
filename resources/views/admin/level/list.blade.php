@extends("layouts.master")

@section("title")
Level List || Albumer
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
                <h4 class="card-title">All Levels</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Challenge</th>
                      <th>Level</th>
                      <th>Reaward Point</th>
                      <th>Description</th>
                     
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Challenge</th>
                      <th>Level</th>
                      <th>Reaward Point</th>
                      <th>Description</th>
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>


                    @foreach($level as $value)
                      <tr>
                        <td>{{ $value->challenge_name }}</td>
                        <td>{{ $value->level_name }}</td>
                        <td>{{$value->reward_points }}</td>
                        <td>{{$value->level_description }}</td>
                      
                        <td class="text-right">
                        <a href="{{route('admin-edit-level',$value->id)}}" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                          <a href="{{route('admin-delete-level',$value->id)}}" class="btn btn-round btn-danger btn-icon btn-sm"><i class="fas fa-times"></i></a>
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


