@extends('Layout.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body ">
                        <form class="form-horizontal" id="reg" role="form" method="POST"
                              action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">


                                <label for="fullname" class="col-md-2 control-label">FullName :</label>

                                <div class=" col-md-9">
                                    <input id="fullname" type="text" class="form-control" name="fullname"
                                           value="{{ old('fullname') }}" required autofocus>

                                    @if ($errors->has('fullname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-2 control-label">UserName :</label>

                                <div class="col-md-9">
                                    <input id="username" type="text" class="form-control" name="username"
                                           value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                                <label for="contact" class="col-md-2 control-label">Mobile :</label>

                                <div class="col-md-9">
                                    <input id="contact" type="number" class="form-control" name="contact" required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-2 control-label">E-Mail :</label>

                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-2 control-label">Department :</label>


                                <div class="col-md-9">
                                    <?php $x = Config::get('department.name');?>

                                    <select name="department" class="form-control">
                                        <option selected="selected" disabled>Choose Department</option>
                                        @foreach($x as $dep)
                                            <option value="{{ $dep}}">
                                                {{ $dep  }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-2 control-label">Role :</label>

                                <div class="col-md-9">
                                    <select id="role" name="role" class=" form-control role">

                                        <option selected="selected" disabled>Choose Role</option>
                                        @foreach ($role as $allrole)
                                            <option value="{{$allrole->id}}">
                                                {{$allrole->display_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('reportsto') ? ' has-error' : '' }}">
                                <label for="reportsto" class="col-md-2 control-label">ReportsTo:</label>


                                <div class="col-md-9">
                                    <select name="reportsto" class="form-control">

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


                            </div>
                            <div class="form-group{{ $errors->has('warehouse_id') ? ' has-error' : '' }}">
                                <label for="warehouse_id" class="col-md-2 control-label">Warehouse :</label>

                                <div class="col-md-9">
                                    <select id="warehouse_id" name="warehouse_id"
                                            class=" form-control warehouse" disabled>

                                        <option selected="selected" disabled>For Factoryincharge</option>
                                        @foreach ($ware as $warehouse)
                                            <option value="{{$warehouse->id}}">
                                                {{$warehouse->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                                <label for="password" class="col-md-2 control-label">Password :</label>

                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control" name="password"
                                           required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm"
                                       class="col-md-2 control-label">RePassword :</label>

                                <div class="col-md-9">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                    <a type="button" class="btn btn-default" href="/user">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
