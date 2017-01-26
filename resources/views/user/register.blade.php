@extends('Layout.app')

@section('main-content')
    <body class="hold-transition register-page">
    <div class="register-box" style="margin-left: 185px; margin-top: 5px">

        <div class="register-box-body" style="width: 185%">
            <div class="col-md-offset-4">
                <h4><b>Register a new User</b></h4>
            </div>

            <form class="form-horizontal" id="reg" role="form" method="POST" style="margin-left: 30px;
                   margin-right: 30px;margin-bottom:0px"
                  action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }} has-feedback">
                    <input id="fullname" type="text" class="form-control" name="fullname" placeholder="Full name"
                           value="{{ old('fullname') }}" required>
                    @if ($errors->has('fullname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                    @endif
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
                    <input id="username" type="text" class="form-control" name="username" placeholder="User name"
                           value="{{ old('username') }}" required>
                    @if ($errors->has('username'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }} has-feedback">
                    <input id="contact" type="number" class="form-control" name="contact" placeholder="Mobile" required>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>

                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <?php $x = Config::get('department.name');?>

                    <select name="department" class="form-control" required>
                        <option selected="selected" disabled>Choose Department</option>
                        @foreach($x as $dep)
                            <option value="{{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                        <select id="roles" name="role" class=" form-control roles" required>

                            <option selected="selected" disabled>Choose Role</option>
                            @foreach ($role as $allrole)
                                <option value="{{$allrole->id}}">
                                    {{$allrole->display_name}}
                                </option>
                            @endforeach
                        </select>

                </div>

                <div class="form-group{{ $errors->has('reportsto') ? ' has-error' : '' }}">
                    <select name="reportsto" class="form-control" required>

                        <option selected="selected" disabled>Choose Reports to</option>
                        @foreach ($role as $allrole)
                            @if($allrole->name!='salesman')
                                <option value="{{$allrole->id}}">

                                    {{$allrole->display_name}}

                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div id="ware" class="form-group{{ $errors->has('warehouse_id') ? ' has-error' : '' }}">
                        <select id="warehouse_id" name="warehouse_id"
                                class=" form-control warehouses" >

                            <option selected="selected" disabled>For Factoryincharge</option>
                            @foreach ($ware as $warehouse)
                                <option value="{{$warehouse->id}}">
                                    {{$warehouse->name}}
                                </option>
                            @endforeach
                        </select>

                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                           required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input id="confirm_password" name="password_confirmation" type="password" class="form-control"
                           placeholder="Retype password" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="form-group" style="padding-top: 30px">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" title="Register User">
                                Register
                            </button>
                            <a type="button" class="btn btn-warning" href="/user">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    </body>
@endsection
