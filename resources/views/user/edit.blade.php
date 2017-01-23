@extends('Layout.app')

@section('main-content')
    <body class="hold-transition register-page">
    <div class="col-md-offset-5">
        <h3><b>Edit User</b></h3>
    </div>
    <div class="box box-info margin-top-5 margin-left-50 margin-right-20 useredit">
        {!! Form::model($user,array('route'=>['user.update',$user->id],'method'=>'PUT', 'class'=>'form-horizontal'))!!}
        <div class="box-body margin-left-10  margin-right-40">


            <div class="form-group">
                {{ Form::label('fullname','Fullname :',array('class'=>'col-sm-2 control-label'))}}
                <div class="col-sm-10">
                    {{ Form::text('fullname',null,array('class'=>'form-control required'))}}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('username','Username :',array('class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10">
                    {{ Form::text('username',null,array('class'=>'form-control required margin-top-5'))}}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('contact','Mobile No. :',array('class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10">
                    {{ Form::number('contact',null,array('class'=>'form-control required margin-top-5'))}}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('email','Email :',array('class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10">
                    {{ Form::text('email',null,array('class'=>'form-control required margin-top-5'))}}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('department','Department :',array('class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10 margin-top-10">
                    <?php $x = Config::get('department.name');?>
                    <select name="department" class="form-control">
                        @foreach($x as $dep)
                            <option value="{{$dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('role','Role :', array('class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10 margin-top-10">
                    <select id="roles" name="role" class="form-control role">
                        <option selected="selected"
                                value="{{$userRoleid->roles_id}}"> {{$userRoleid->role_name}}</option>

                        @foreach ($role as $allrole)
                            <option value="{{$allrole->id}}">
                                {{$allrole->display_name}}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="form-group">
                {{ Form::label('reportsto','Reports To :', array('class'=>'col-sm-2 control-label margin-top-5'))}}

                <div class="col-sm-10 margin-top-10">
                    <select name="reportsto" class="form-control">
                        <option selected="selected"
                                value="{{$reportsTo->role_id}}">{{$reportsTo->display_name}}</option>
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

            <div class="form-group">
                @if( $userRoleid->role_name=='factoryincharge')
                    {{ Form::label('Warehouse :', null, array('id'=>'warehouse_id', 'class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10 margin-top-10">
                    <div id="ware">
                        <select id="warehouses" name="warehouse_id" class="form-control warehouses"
                                visibility="hidden">
                            <option selected="selected" value="{{$factoryWarehouse->warehouse_id}}"> {{$factoryWarehouse->warehousename}}
                            </option>
                            @foreach ($ware as $warehouse)
                                <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @else
                    {{ Form::label('Warehouse :', null, array('id'=>'warehouse_id', 'class'=>'col-sm-2 control-label margin-top-5'))}}
                <div class="col-sm-10 margin-top-10">
                    <div id="ware">
                        <select id="warehouses" name="warehouse_id" class="form-control">
                            <option selected="selected" disabled>For Factoryincharge</option>
                            @foreach ($ware as $warehouse)
                                <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="form-group" style="padding-top: 30px">
                    <div class="col-md-9 col-md-offset-5">
                        <button type="submit" class="btn btn-success margin-top-10 margin-bottom-20" title="Save Changes">
                            Save Change
                        </button>
                        <a type="button" class="btn btn-warning margin-top-10 margin-bottom-20 margin-left-10" href="/user"
                        >
                            Cancel
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    </body>

    <script>
        var edituser=true;
        var roletype ='{{$userRoleid->roles_id}}';
    </script>
    <!-- /.register-box -->

@endsection



