@extends('Layout.app')

@section('main-content')
    <?php

    $zonesDistrict = config('distributor.district');

    ?>


    <div class="col-md-6 ">


        <h3>Add Billing/Shipping Address</h3>
        <div class="box box-info clearfix ">

            {!! Form::open(array('route' => 'add_distributor_address'))!!}

            {{ Form::hidden('distributor_id', $disid->id) }}
            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Type</label>
                <div class="col-md-8">
                    <?php $addressType = Config::get('distributor.address_type');?>
                    <select name="type" class="form-control" required >
                        @foreach($addressType as $index=>$value)
                            <option value="{{$index}}"
                                    @if($type==$index) selected
                                         @else
                                             disabled
                                    @endif >{{$value}} </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="zone" class="col-sm-4 control-label">Zone</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.zone');?>
                    <select class="form-control zones-dropdown" required id="dropdown_selector " name="zone">
                        <option selected="selected" value="" disabled>Choose Zone</option>
                        @foreach($x as $dep)
                            <option id="{{$dep}}" value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
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

            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }} clearfix">
                <label for="city" class="col-sm-4 control-label">City</label>

                <div class="col-sm-8">
                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required
                           autofocus>

                    @if ($errors->has('city'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }} clearfix">
                <label for="latitude" class="col-sm-4 control-label">Latitude</label>

                <div class="col-sm-8">
                    <input id="latitude" type="integer" class="form-control" name="latitude"
                           value="{{ old('latitude') }}"
                           required autofocus>

                    @if ($errors->has('latitude'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }} clearfix">
                <label for="longitude" class="col-sm-4 control-label">Longitude</label>

                <div class="col-sm-8">
                    <input id="longitude" type="integer" class="form-control" name="longitude"
                           value="{{ old('longitude') }}"
                           required autofocus>

                    @if ($errors->has('longitude'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} clearfix">
                <label for="phone" class="col-sm-4 control-label">Phone</label>

                <div class="col-sm-8">
                    <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}"
                           required autofocus>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} clearfix">
                <label for="mobile" class="col-sm-4 control-label">Mobile</label>

                <div class="col-sm-8">
                    <input id="mobile" type="number" class="form-control" name="mobile" value="{{ old('mobile') }}"
                           required autofocus>

                    @if ($errors->has('mobile'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }} clearfix">
                <label for="fax" class="col-sm-4 control-label">Fax</label>

                <div class="col-sm-8">
                    <input id="fax" type="number" class="form-control" name="fax" value="{{ old('fax') }}"
                           autofocus>

                    @if ($errors->has('fax'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="clearfix"></div>
            {{Form::submit('Save Address', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
            <a type="button" class="btn btn-warning btn-block" href="/distributor/{{$disid->id}}">Cancel</a>
            {!! Form::close() !!}


        </div>

    </div>


@endsection

<script>

    var zonesDistrict = {!! json_encode($zonesDistrict) !!};

</script>