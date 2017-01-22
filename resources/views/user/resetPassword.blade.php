@extends('Layout.app')

@section('main-content')
    <div class="container">
            @role((['admin','director','generalmanager']))
            <div class="col-md-5 margin-top-20">
                <div class="panel panel-default" style="padding: 20px">

                    {!! Form::model($user,array('route'=>['resetpassword',$user->id],'method'=>'PATCH' ))!!}
                    <h3 class="col-md-offset-3 margin-top-10 margin-bottom-30">Reset password </h3>
                    <div class="form-group ">

                        <div class="row">
                            <div class="col-md-10 margin-left-30">
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

                                <div class="col-md-10 margin-top-20 margin-left-30">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-offset-4">
                        {{Form::submit('Save', array('class'=>'btn btn-success margin-top-20'))}}
                        <a type="button" class="btn btn-warning margin-top-20 margin-left-10" href="/user">Cancel</a>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
            @endrole

    </div>

@endsection
