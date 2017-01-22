@extends('Layout.app')

@section('main-content')
    <div class="container">

        @if($user->id==Auth::user()->id)
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default" style="padding: 20px">


                        {!! Form::model($user,array('route'=>['changepassword',$user->id],'method'=>'PATCH' ))!!}
                        <h3>Change Password</h3>
                        <div class="form-group ">

                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="oldpassword" type="password" class="form-control" name="oldpassword"
                                           placeholder="Old Password"
                                           required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <div class="row">


                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password"
                                               placeholder="New Password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                          <strong>{{ $errors->first('password') }}</strong>
                                                          </span>
                                        @endif
                                    </div>


                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div align="right">
                            {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                            <a type="button" class="btn btn-warning " href="/user">Cancel</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
    @endif

@endsection
