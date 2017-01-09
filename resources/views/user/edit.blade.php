@extends('Layout.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit User</div>
                    <div class="panel-body">


                        {!! Form::model($user,array('route'=>['user.update',$user->id],'method'=>'PUT' ))!!}
                        {{ Form::label('fullname','Fullname:')}}
                        {{ Form::text('fullname',null,array('class'=>'form-control reqiured'))}}
                        {{ Form::label('username','Username:')}}
                        {{ Form::text('username',null,array('class'=>'form-control'))}}
                        {{ Form::label('contact','Mobile No. :')}}
                        {{ Form::text('contact',null,array('class'=>'form-control'))}}
                        {{ Form::label('email','Email:')}}
                        {{ Form::text('email',null,array('class'=>'form-control'))}}
                        {{ Form::label('department','Department:')}}

                        <?php $x = Config::get('department.name');?>
                        <select name="department" class="form-control">
                            @foreach($x as $dep)
                                <option value=" {{ $dep}}">
                                    {{ $dep  }}
                                </option>
                            @endforeach
                        </select>

                        {{ Form::label('role','Role:')}}
                        <select name="role" class="form-control">
                            <option selected="selected"
                                    value="{{$userRoleid->roles_id}}"> {{$userRoleid->role_name}}</option>
                            @foreach ($role as $allrole)

                                <option value=" {{$allrole->id}}">
                                    {{$allrole->display_name}}
                                </option>
                            @endforeach
                        </select>

                        {{ Form::label('reportsto','Reports To:')}}

                        @foreach($reportsTo as $r)
                            <select name="reportsto" class="form-control">
                                <option selected="selected">{{$r->display_name}}</option>
                                @foreach ($role as $allrole)
                                    @if($allrole->name!='salesman')
                                        <option value=" {{$allrole->id}}">

                                            {{$allrole->display_name}}

                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        @endforeach


                        {{Form::submit('Save change', array('class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px;'))}}

                        {{Form::submit('Cancel', array('class'=>'btn btn-danger btn-lg btn-block',' style'=>'margin-top:20px;'))}}
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
