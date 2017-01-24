@extends('Layout.app')

@section('main-content')
    <?php

    $zonesDistrict = config('distributor.district');

    ?>

    <?php $addressType = Config::get('distributor.address_type');?>

    {{--@foreach($addressType as $index=>$value)--}}
        {{--@if($type==$index)--}}
            {{--<h3>edit {{$value}} Address</h3>--}}
        {{--@endif--}}

    {{--@endforeach--}}

    <div class="col-md-6 ">
        <div class="box box-info clearfix pad ">
            {{--@foreach($addressType as $index=>$value)--}}
                {{--@if($type==$index)--}}
                    {{--{!! Form::model($address[$value], array('route'=>['update_distributor_address',$dist->id],'method'=>'PUT' ))!!}--}}
                {{--@endif--}}

            {{--@endforeach--}}
                {{ Form::hidden('distributor_id', $dist->id) }}

                <div class="form-group clearfix">
                    <label for="type" class="col-sm-4 control-label">Type</label>
                    <div class="col-md-8">
                        <?php $addressType = Config::get('distributor.address_type');?>
                        <select name="type" class="form-control" required >
                            {{--@foreach($addressType as $index=>$value)--}}
                                {{--<option value="{{$index}}"--}}
                                        {{--@if($type==$index) selected--}}
                                        {{--@else--}}
                                        {{--disabled></option>--}}
                                        {{--@endif >{{$value}} </option>--}}
                            {{--@endforeach--}}

                        </select>
                    </div>
                </div>



            <div class="form-group clearfix">
                <label for="zone" class="col-sm-4 control-label">Zone</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.zone');?>
                    <select class="form-control zones-dropdown" id="dropdown_selector " name="zone">

                      @if(isset($address[$value]['zone']))
                            <option selected="selected" value="{{$address[$value]['zone']}}" >{{$address[$value]['zone']}}</option>
                       @endif
                        @foreach($x as $dep)
                            <option id="{{$dep}}" value="{{$dep}}">
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

                        <select class="form-control district-dropdown" id="dropdown_selector" name="district">
                            @if(isset($address[$value]['zone']))
                            <option selected="selected" value="{{$address[$value]['district']}}" disabled>{{$address[$value]['district']}} </option>
                            @endif

                        </select>

                    </div>
                </div>

            <div class="form-group clearfix">
                <label for="city" class="col-sm-4 control-label">City</label>

                <div class="col-sm-8">
                    {{ Form::text('city',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
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
            {{Form::submit('Save changes', array('class'=>'btn btn-success col-md-offset-4 margin-top-20', 'title'=>'Save Edit Address'))}}
            <a type="button" class="btn btn-warning margin-top-20" href="/dist_address/{{$dist->id}}">Cancel</a>
            {!! Form::close() !!}


        </div>

    </div>




@endsection

<script>

    var zonesDistrict = {!! json_encode($zonesDistrict) !!};

</script>



