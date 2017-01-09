@extends('Layout.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body col-md-offset-1">
                        <form class="form-horizontal" id="reg" role="form" method="POST"
                              action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">

                                <div class="row">
                                    <label for="fullname" class="col-md-1 control-label">FullName</label>

                                    <div class="col-md-4">
                                        <input id="fullname" type="text" class="form-control" name="fullname"
                                               value="{{ old('fullname') }}" required autofocus>

                                        @if ($errors->has('fullname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                        <label for="department" class="col-md-1 control-label">Department</label>


                                        <div class="col-md-4">
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
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-1 control-label">UserName</label>

                                    <div class="col-md-4">
                                        <input id="username" type="text" class="form-control" name="username"
                                               value="{{ old('username') }}" required autofocus>

                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role" class="col-md-1 control-label">Role</label>

                                        <div class="col-md-4">
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

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="contact" class="col-md-1 control-label">Mobile :</label>

                                    <div class="col-md-4">
                                        <input id="contact" type="number" class="form-control" name="contact" required>
                                    </div>

                                    <div class="form-group{{ $errors->has('reportsto') ? ' has-error' : '' }}">
                                        <label for="reportsto" class="col-md-1 control-label">Reportsto</label>


                                        <div class="col-md-4">
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
                                </div>


                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="row">

                                        <label for="email" class="col-md-1 control-label">E-Mail</label>

                                        <div class="col-md-4">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('warehouse_id') ? ' has-error' : '' }}">
                                            <label for="warehouse_id" class="col-md-1 control-label">Warehouse</label>

                                            <div class="col-md-4">
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
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                        <script>$('.role').change(function () {
                                                $(".warehouse").prop("disabled", this.value != 4);
                                            });
                                        </script>
                                    </div>

                                </div>


                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                    <div class="row">
                                        <label for="password" class="col-md-1 control-label">Password</label>

                                        <div class="col-md-4">
                                            <input id="password" type="password" class="form-control" name="password"
                                                   required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <label for="password-confirm"
                                                   class="col-md-1 control-label">RePassword</label>

                                            <div class="col-md-4">
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
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
