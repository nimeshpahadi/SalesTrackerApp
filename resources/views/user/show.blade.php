@extends('Layout.app')

@section('main-content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <h1 align="center"> {{$user->username}}</h1>
                    <!-- /.box-header -->


                    <div class="container-fluid ">

                        <div class="col-md-12 ">

                            <div class="row">
                                <h3> Details</h3>
                                <div align="right">
                                    <div class="col-md-11 col-sm-10">


                                        {!! Html::linkRoute('user.edit','edit',array($user->id),array('class'=>'btn btn-success glyphicon glyphicon-edit '))!!}

                                        @if(Auth::user()->id==$user->id)
                                            {!! Html::linkRoute('password','change password',array($user->id),array('class'=>'btn btn-primary'))!!}
                                        @endif
                                    </div>
                                    {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id]]) !!}
                                    <button type="submit" class="btn btn-danger glyphicon glyphicon-trash "
                                            onclick="return confirm('Are you sure you want to delete this item?');">

                                    </button>
                                    {!! Form::close() !!}

                                </div>
                            </div>

                            <hr>
                            <div align="" class="col-md-10 col-md-offset-2">


                                <div class="row">
                                    <label class="col-sm-6 ">Contact Name :</label>
                                    {{$user->fullname}}
                                </div>
                                <div class="row">
                                    <label class="col-sm-6 ">Email :</label>
                                    {{$user->email}}
                                </div>

                                <div class="row">
                                    <label class="col-sm-6 ">Mobile :</label>
                                    {{$user->contact}}
                                </div>
                                <div class="row">
                                    <label class="col-sm-6 ">Department :</label>
                                    {{$user->department}}
                                </div>
                                <div class="row">
                                    <label class="col-sm-6 ">Role :</label>
                                    @foreach($userRoles as $role)
                                        @if($user->username==$role->user_name)
                                            <td>{{$role->display_name}}</td>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="row">
                                    <label class="col-sm-6 ">Reports To :</label>
                                    @foreach($reportsTo  as $role)
                                        <td>{{$role->display_name}}</td>
                                    @endforeach

                                </div>


                            </div>


                            <div class="col-md-6">


                                {{--</div>--}}
                            </div>
                        </div>


                    </div>


                </div>


            </div>


        </div>
        <!-- /.box-body -->

        <!-- /.row -->
    </section>
    <!-- /.content -->




@endsection
