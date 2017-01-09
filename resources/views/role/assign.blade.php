@extends('Layout.app')



@section('main-content')



    <div class="row">
        <div class="col-md-8">


            <table border="4" class="table table-hover ">
                <h3>Assign role for first time</h3>
                @foreach($user as $users)
                    <div class="row">

                        <tr>

                            <td>{{$users->name}}'s Role</td>

                            <td>
                                {!! Form::open(array( 'url'=>('/role/assignrole')  ,'enctype' => 'multipart/form-data' ,'class' => 'form')) !!}
                                <select name="role_id" class="form-control">

                                    @foreach ($roles as $role)
                                        <option value=" {{$role->id}}">
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>

                                {{ Form::hidden('user_id', $users->id) }}
                            </td>
                            <td> {!! Form::submit('submit',array('class' =>'btn btn-primary  col-md-offset-3')) !!}</td>

                        </tr>

                        {!! Form::close() !!}
                    </div>

                @endforeach
            </table>
        </div>


    </div>


@endsection


<!-- Control Sidebar -->



