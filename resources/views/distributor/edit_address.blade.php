@extends('Layout.app')

@section('main-content')
    <?php

    $zonesDistrict = config('distributor.district');

    ?>
    <div class="col-md-6 ">


        <h3>Edit Billing/Shipping Address</h3>
        <div class="box box-info clearfix ">

            {!! Form::model($dist,array('route'=>['update_distributor_address',$dist->id],'method'=>'PUT' ))!!}





            {{ Form::hidden('distributor_id', $dist->id) }}
            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Type</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.address_type');?>
                    <select name="type" class="form-control">
                        @foreach($address as $a)
                            <option selected="selected">{{$a->type}}</option>
                        @endforeach
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="zone" class="col-sm-4 control-label">Zone</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.zone');?>
                    <select class="form-control zones-dropdown" required id="dropdown_selector " name="zone">
                        <option selected="selected" value="" disabled>{{$dist->zone}}</option>
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
                        <option selected="selected" value="" disabled>{{$dist->district}} </option>


                    </select>

                </div>
            </div>

            <div class="form-group clearfix">
                <label for="city" class="col-sm-4 control-label">City</label>

                <div class="col-sm-8">
                    {{ Form::text('city',null,array('class'=>'"col-sm-8 form-control'))}}                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group clearfix">
                <label for="latitude" class="col-sm-4 control-label">Latitude</label>
                <div class="col-sm-8">
                    {{ Form::text('latitude',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="longitude" class="col-sm-4 control-label">Longitude</label>
                <div class="col-sm-8">
                    {{ Form::text('longitude',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="phone" class="col-sm-4 control-label">Phone</label>
                <div class="col-sm-8">
                    {{ Form::text('phone',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="mobile" class="col-sm-4 control-label">Mobile</label>
                <div class="col-sm-8">
                    {{ Form::text('mobile',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="fax" class="col-sm-4 control-label">Fax</label>
                <div class="col-sm-8">
                    {{ Form::text('fax',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>


            <div class="clearfix"></div>
            {{Form::submit('Save changes', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
            <a type="button" class="btn btn-warning btn-block" href="/dist_address/{{$dist->id}}">Cancel</a>
            {!! Form::close() !!}


        </div>

    </div>




@endsection

<script>

    var zonesDistrict = {!! json_encode($zonesDistrict) !!};

</script>



