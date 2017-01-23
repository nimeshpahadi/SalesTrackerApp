@extends('Layout.app')

@section('main-content')

    @role((['admin','generalmanager','director']))

    <div class="row-md-12">
        <div align="right">
            <a href="{{ url('/user/create') }}" class="btn btn-success  fa fa-user-plus" title="Create New User"> Create User</a>
        </div>
    </div>

    @endrole
    <div class="clearfix">

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box" style="padding: 10px">
                <div class="box-header">
                    <h3 class="box-title">User Details</h3>
                </div>

                <div class="box-body table-responsive no-padding">

                    <table id="example1"
                           class="table table-striped table-bordered dt-responsive  table-responsive "
                           cellspacing="0" width="100%">
                        <thead>
                        <tr style="background-color: #8aa4af ">
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($user as $users)
                            <tr>
                                <td>{{$users->fullname}}</td>
                                <td>{{$users->email}}</td>
                                <td>{{$users->contact}}</td>
                                <td>{{$users->department}}</td>

                                @foreach($userRoles as $role)
                                    @if($users->username==$role->user_name)
                                        <td>{{$role->display_name}}</td>
                                    @endif
                                @endforeach

                                <td>
                                    {!! Html::linkRoute('user.show','View',array($users->id),array('class'=>'btn btn-success ', 'title'=>"View user details of {$users->fullname}"))!!}

                                    @role(('admin'))
                                    <a href="{{route('passwordreset',$users->id)}}">
                                        <button class="btn btn-warning" data-toggle="popover" data-trigger="hover"
                                                data-placement="top" data-content="Reset Password for  {{$users->fullname}}"><i class="fa fa-repeat"  ></i></button>
                                    </a>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>

@endsection
