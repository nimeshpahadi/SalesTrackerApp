@extends('Layout.app')

@section('main-content')

    <div class=" col-md-8 col-md-offset-2">
        <h3>Edit Customer</h3>
        <div class="box box-info clearfix ">

            {!! Form::model($customerAreaId, array('route'=>['area.update', $customerAreaId->id],'method'=>'PUT' ))!!}

            <div class="form-group clearfix pad-top">
                <label for="district" class="col-sm-4 control-label">District</label>
                <div class="col-sm-8">
                    {{ Form::text('district',null,array('class'=>'form-control'))}}
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="area_name" class="col-sm-4 control-label">Area Name</label>

                <div class="col-sm-8">
                    {{ Form::text('area_name',null,array('class'=>'"col-sm-8 form-control'))}}

                </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group clearfix">
                <label for="places" class="col-sm-4 control-label">Places</label>
                <div class="col-sm-8">
                    {{ Form::text('places',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>

            <div align="right" class=" pad">
                {{Form::submit('Save Changes', array('class'=>'btn btn-primary ','title'=>"Save Customer Area"))}}
                <a type="button" class="btn btn-warning " href="{{ route('area.index') }}">Cancel</a>
                {!! Form::close() !!}
            </div>

        </div>

    </div>
@endsection
