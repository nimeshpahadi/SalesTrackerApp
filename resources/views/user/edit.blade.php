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
                                <option value="{{$dep}}">
                                    {{ $dep  }}
                                </option>
                            @endforeach
                        </select>

                        {{ Form::label('role','Role:')}}
                        <select id="role" name="role" class="form-control role">
                            <option selected="selected"
                                    value="{{$userRoleid->roles_id}}"> {{$userRoleid->role_name}}</option>

                            @foreach ($role as $allrole)
                                <option value="{{$allrole->id}}">
                                    {{$allrole->display_name}}
                                </option>
                            @endforeach
                        </select>

                        {{ Form::label('reportsto','Reports To:')}}

                        <select name="reportsto" class="form-control">
                            <option selected="selected"
                                    value="{{$reportsTo->role_id}}" >{{$reportsTo->display_name}}</option>
                            @foreach ($role as $allrole)
                                @if($allrole->name!='salesman')
                                    <option value="{{$allrole->id}}">

                                        {{$allrole->display_name}}

                                    </option>
                                @endif
                            @endforeach
                        </select>




                        @if( $userRoleid->role_name=='factoryincharge')
                            {{ Form::label('warehouse_id','Warehouse:')}}


                            <select id="warehouse_id" name="warehouse_id"
                                    class=" form-control warehouse">
                                {{--<option selected="selected"--}}
                                        {{--value="{{$factoryWarehouse->warehouse_id}}"> {{$factoryWarehouse->warehousename}}</option>--}}

                                @foreach ($ware as $warehouse)
                                    <option value="{{$warehouse->id}}">
                                        {{$warehouse->name}}
                                    </option>
                                @endforeach
                            </select>
                        @else

                            {{ Form::label('warehouse_id','Warehouse:')}}


                            <select id="warehouse_id" name="warehouse_id"
                                    class=" form-control warehouse">
                                <option selected="selected" disabled>For Factoryincharge</option>
                            @foreach ($ware as $warehouse)
                                    <option value="{{$warehouse->id}}">
                                        {{$warehouse->name}}
                                    </option>
                                @endforeach
                            </select>
                        @endif


                        {{Form::submit('Save change', array('class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px;'))}}

                        {{Form::submit('Cancel', array('class'=>'btn btn-danger btn-lg btn-block',' style'=>'margin-top:20px;'))}}
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
