@extends('Layout.app')

@section('main-content')

    <?php

    $zonesDistrict = config('distributor.district');

    ?>

    <div class=" col-md-8 col-md-offset-2">
        <h3>Edit Customer</h3>
        <div class="box box-info clearfix pad">

            {!! Form::model($customerAreaId, array('route'=>['area.update', $customerAreaId->id],'method'=>'PUT' ))!!}

            <div class="form-group{{ $errors->has('zone') ? ' has-error' : '' }} clearfix">
                <label for="zone" class="col-sm-4 control-label">Zone</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.zone');?>
                    <select class="form-control zones-dropdown" required id="dropdown_selector " name="zone">
                        <option selected="selected" value="" disabled>Choose Zone</option>
                        @foreach($x as $dep)
                            <option id="{{$dep}}" value=" {{ $dep}}" value="{{ old('zone') }}">
                                {{ $dep  }}
                            </option>
                            @if ($errors->has('zone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('zone') }}</strong>
                                    </span>
                            @endif
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form-group clearfix">
                <label for="zone" class="col-sm-4 control-label">District</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.zone'); ?>

                    <select class="form-control district-dropdown" required id="dropdown_selector" name="district">
                        <option selected="selected" value="" disabled>Choose district</option>
                    </select>

                </div>
            </div>

            <div class="form-group clearfix">
                <label for="area_name" class="col-sm-4 control-label">Area Name</label>

                <div class="col-sm-8">
                    {{ Form::text('area_name',null,array('class'=>'"col-sm-8 form-control'))}}

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }} clearfix">
                <label for="places" class="col-sm-4 control-label">Places</label>

                <div class="col-sm-8">
                    <input id="places" type="text" class="form-control" name="places"
                           value="{{join(",", json_decode($customerAreaPlaces->places))}}"
                           required
                           autofocus placeholder="insert places seperated by comma (,)">
                </div>
            </div>

            <div align="right" class=" pad">
                {{Form::submit('Save Changes', array('class'=>'btn btn-primary ','title'=>"Save Customer Area"))}}
                <a type="button" class="btn btn-warning " href="{{ route('area.index') }}">Cancel</a>
                {!! Form::close() !!}
            </div>

        </div>

    </div>

    <script>

        var zonesDistrict = {!! json_encode($zonesDistrict) !!};

    </script>
@endsection
