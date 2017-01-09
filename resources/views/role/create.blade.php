@extends('Layout.app')



@section('main-content')


    @role(('admin'))


    @endrole
    <div class="row">
        <div class="col-md-5">


            {!! Form::open(array('route'=>'role.store'))!!}
            {{ Form::label('name','Name:')}}
            {{ Form::text('name',null,array('class'=>'form-control'))}}
            {{ Form::label('display_name','display_name:')}}
            {{ Form::text ('display_name',null,array('class'=>'form-control'))}}
            {{ Form::label('description','description:')}}
            {{ Form::text ('description',null,array('class'=>'form-control'))}}
            {{Form::submit('Create Role', array('class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
            <a type="button" class="btn btn-warning btn-block" href="/user">
                Cancel
            </a>
    {!! Form::close() !!}






@endsection



