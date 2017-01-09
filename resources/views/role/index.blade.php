@extends('Layout.app')



@section('main-content')


    @role(('admin'))


    @endrole
    <div class="row">
        <div class="col-md-8">

            <div class="box-body table-responsive no-padding">
                <table border="4" class="table table-hover ">
                    <h2> Users Role</h2>
                    <tr>

                        <th>User Name</th>
                        <th>Role Name</th>
                        <th>Edit</th>


                    </tr>


                    @foreach($userRoles as $role)
                        <tr>
                            <td>{{$role->user_name}}</td>
                            <td>{{$role->role_name}}</td>
                            <td>
                                {!! Html::linkRoute('role.edit','Edit',array($role->user_id),array('class'=>'btn btn-primary btn-block'))!!}
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        {{--start flash message--}}
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                                                                                             data-dismiss="alert"
                                                                                             aria-label="close">&times;</a>
                    </p>
                @endif
            @endforeach
        </div>
        {{--end flash message--}}




        {{--<div class="col-md-6">--}}
        {{--<table border="4" class="table table-hover ">--}}

        {{--<h3>Assign role for first time</h3>--}}



        {{--@foreach($user as $userss)--}}
        {{--<div class="row">--}}
        {{--<tr>--}}
        {{--<td>{{$userss->name}}'s Role</td>--}}
        {{--<td>--}}
        {{--{!! Form::open(array( 'url'=>('/role/assignrole')  ,'enctype' => 'multipart/form-data' ,'class' => 'form')) !!}--}}
        {{--<select name="role_id" class="form-control">--}}

        {{--@foreach ($allrole as $role)--}}
        {{--<option value=" {{$role->id}}">--}}
        {{--{{$role->name}}--}}
        {{--</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}

        {{--{{ Form::hidden('user_id', $userss->id) }}--}}
        {{--</td>--}}
        {{--<td> {!! Form::submit('submit',array('class' =>'btn btn-primary  col-md-offset-3')) !!}</td>--}}

        {{--</tr>--}}
        {{--@endif--}}

        {{--{!! Form::close() !!}--}}
        {{--</div>--}}



        {{--@endforeach--}}

        {{--</table>--}}
        {{--</div>--}}
    </div>


@endsection


<!-- Control Sidebar -->



