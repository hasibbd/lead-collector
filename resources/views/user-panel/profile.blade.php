<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | User Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!--Toaster-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Main content -->
<div class="container py-5">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('/dist/img/user4-128x128.jpg')}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{session('name')}}</h3>

                            <p class="text-muted text-center">{{session('email')}}</p>

                          {{--  <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>--}}

                            <a href="{{url('logout')}}" class="btn btn-primary btn-block"><b>Logout</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                              <li class="nav-item "><a class="nav-link active" href="#application" data-toggle="tab">Appliaction</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="application">
                                   <div class="card">
                                       <div class="card-header text-right">
                                           <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">New Application</button>
                                       </div>
                                       <div class="card-body">
                                           <table class="table table-sm small">
                                               <thead>
                                               <tr>
                                                   <th>No</th>
                                                   <th>Application ID</th>
                                                   <th>Application</th>
                                                   <th>Submitted Date</th>
                                                   <th>Status</th>
                                                   <th>Action</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               @foreach($application as $a)
                                               <tr>
                                                   <td>{{$loop->iteration}}</td>
                                                   <td>{{$a->app_id}}</td>
                                                   <td>{{$a->name}}</td>
                                                   <td>{{date("F j, Y, g:i a",strtotime($a->ap_date))}}</td>
                                                   <td>
                                                       @if($a->a_status == 0)
                                                           <span class="badge badge-info p-2">Pending</span>
                                                       @elseif($a->a_status == 1)
                                                           <span class="badge badge-success p-2">Accepted</span>
                                                       @elseif($a->a_status == -2)
                                                           <span class="badge badge-success p-2">Re-Submitted</span>
                                                       @elseif($a->a_status == -5)
                                                           <span class="badge badge-warning p-2">Draft</span>
                                                       @else
                                                           <span class="badge badge-warning p-2">Edit Requested</span>
                                                       @endif
                                                   </td>
                                                   <td>
                                                       @if($a->a_status == 0)
                                                           <button onclick="appView({{$a->app_id}})" class="btn btn-sm btn-primary">View</button>
                                                       @elseif($a->a_status == 1)
                                                          <button onclick="appView({{$a->app_id}})" class="btn btn-sm btn-primary">View</button>
                                                       @elseif($a->a_status == -2)
                                                          <button onclick="appView({{$a->app_id}})" class="btn btn-sm btn-primary">View</button>
                                                       @elseif($a->a_status == -5)
                                                           <a href="{{url('app-draft/'.$a->app_id)}}" class="btn btn-sm btn-warning">Edit</a>
                                                       @else
                                                           <a href="{{url('app-edit/'.$a->app_id)}}" class="btn btn-sm btn-warning">Edit</a>
                                                       @endif
                                                   </td>
                                               </tr>
                                               @endforeach
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" id="profile_change">
                                        <input type="hidden" name="user_id" value="{{session('user_id')}}">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{session('name')}}" name="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" value="{{session('email')}}" name="email"  placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="c_password" name="c_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- ./wrapper -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-8 offset-2">
                       <table class="table">
                           <tbody>
                           @foreach($application_type as $a)
                               <tr>
                                   <td>{{$a->name}}</td>
                                   <td><a href="{{url('apply/'.$a->id)}}" class="btn btn-sm btn-primary">Apply</a></td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('user-panel.modal')
<!-- jQuery -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('custom/js/edit.js')}}"></script>
<script src="{{asset('custom/js/store.js')}}"></script>
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
