@extends("layouts.master")

@section("title")
All Users || Bredge
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
                <h4 class="card-title">All Users</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                       <th>Bio</th>
                      <th>Role</th>
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Bio</th>
                      <th>Role</th>
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>


                    @foreach($users as $user)
                      <tr>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>+1-{{$user->contact }}</td>
                       
                         <td>{{$user->bio}}</td>
                          <td>{{$user->role}}</td>
                        <td class="text-right">
                          <!-- <a href="#" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="far fa-calendar-alt"></i></a> -->
                          <a href="{{ route('user.delete',$user->id) }}" class="btn btn-round btn-danger btn-icon btn-sm"><i class="fas fa-times"></i></a>
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


