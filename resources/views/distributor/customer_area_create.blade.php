@extends('Layout.app')

@section('main-content')

    <?php

    $zonesDistrict = config('distributor.district');

    ?>

    <div class="panel-body">

        <div class="col-md-8 col-md-offset-2">

            <h3>Customer Area</h3>
            <div class="box box-info clearfix pad ">

                {!! Form::open(array('route'=>'area.store'))!!}

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

                <div class="form-group{{ $errors->has('area_name') ? ' has-error' : '' }} clearfix">
                    <label for="area_name" class="col-sm-4 control-label">Area Name</label>

                    <div class="col-sm-8">
                        <input id="area_name" type="text" class="form-control" name="area_name"
                               value="{{ old('area_name') }}" required autofocus>
                        @if ($errors->has('area_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('area_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('places') ? ' has-error' : '' }} clearfix">
                    <label for="places" class="col-sm-4 control-label">Places</label>

                    <div class="col-sm-8">
                        <input id="places" type="text" class="form-control" name="places"
                               value="{{ old('places') }}" required autofocus>
                        @if ($errors->has('places'))
                            <span class="help-block">
                                <strong>{{ $errors->first('places') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="clearfix pad"></div>

                <div align="right">
                    {{Form::submit('Create', array('class'=>'btn btn-sm btn-primary ','title'=>'create customer area'))}}
                    <a type="button" class="btn btn-sm btn-warning" href="{{ route('area.index') }}">Cancel</a>
                    {!! Form::close() !!}
                </div>

            </div>

            <script>

                var zonesDistrict = {!! json_encode($zonesDistrict) !!};

            </script>

@endsection