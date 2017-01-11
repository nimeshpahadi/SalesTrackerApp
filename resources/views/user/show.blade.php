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
                                        {!! Html::linkRoute('user.edit','edit',array($user->id),
                                                  array('class'=>'btn btn-success glyphicon glyphicon-edit '))!!}
                                    </div>

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
                                        <td>{{$reportsTo->display_name}}</td>

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
