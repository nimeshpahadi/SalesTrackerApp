@extends('Layout.app')

@section('main-content')

    @role((['admin','generalmanager','director']))

    <div class="col-md-12">
        <div align="right">
            <a href="{{ url('/user/create') }}" class="btn btn-success  fa fa-edit"> Create User</a>

        </div>
    </div>
    @endrole
    <div class="clearfix">

    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User Details</h3>


                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr style="background-color: #8aa4af ">
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

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
                                    {!! Html::linkRoute('user.show','View',array($users->id),array('class'=>'btn btn-success '))!!}

                                    {!! Html::linkRoute('passwordreset','Reset password',array( $users->id),array('class'=>''))!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>


@endsection
