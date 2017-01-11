@extends('Layout.app')

@section('main-content')
    <?php

    $zonesDistrict = config('distributor.district');

    ?>

    <div class=" col-md-8 col-md-offset-2">
        <h3>Edit Customer</h3>
        <div class="box box-info clearfix ">


            {!! Form::model($dist,array('route'=>['distributor.update',$dist->id],'method'=>'PUT' ))!!}

            <div class="form-group clearfix">
                <label for="company_name" class="col-sm-4 control-label">Company Name</label>
                <div class="col-sm-8">
                    {{ Form::text('company_name',null,array('class'=>'form-control'))}}
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="contact_name" class="col-sm-4 control-label">Contact Name</label>

                <div class="col-sm-8">
                    {{ Form::text('contact_name',null,array('class'=>'"col-sm-8 form-control'))}}

                </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group clearfix">
                <label for="email" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    {{ Form::text('email',null,array('class'=>'"col-sm-8 form-control'))}}
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
<input  hidden name="id" value="{{$dist->id}}">

            <div class="form-group clearfix">
                <label for="zone" class="col-sm-4 control-label">Zone</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.zone');?>
                    <select class="form-control zones-dropdown" required id="dropdown_selector " name="zone">
                        <option selected="selected" value="{{$dist->zone}}">{{$dist->zone}}</option>
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
                        <option selected="selected" value="{{$dist->district}}">{{$dist->district}}</option>


                    </select>

                </div>
            </div>
            <div class="form-group clearfix">
                <label for="latitude" class="col-sm-4 control-label">Latitude</label>
                <div class="col-sm-8">
                    {{ Form::text('latitude',null,array('class'=>'col-sm-8 form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="longitude" class="col-sm-4 control-label">Longitude</label>
                <div class="col-sm-8">
                    {{ Form::text('longitude',null,array('class'=>'col-sm-8 form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="open_date" class="col-sm-4 control-label">Open Date</label>
                <div class="col-sm-8">
                    {{ Form::text('open_date',null,array('class'=>'col-sm-8 form-control','id'=>'date'))}}
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="lead_source" class="col-sm-4 control-label">Lead Source</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.lead_source');?>
                    <select name="lead_source" class="form-control">
                        <option selected="selected">{{$dist->lead_source}}</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Type</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.distributor_type');?>
                    <select name="type" class="form-control">
                        <option selected="selected">{{$dist->type}}</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="mobile" class="col-sm-4 control-label">Vat/Pan number</label>
                <div class="col-sm-8">
                    {{ Form::text('vat_no',null,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>


            <div align="right" class=" row">
            {{Form::submit('Save Changes', array('class'=>'btn btn-primary '))}}
            <a type="button" class="btn btn-warning " href="/distributor/{{ $dist->id }}">Cancel</a>
            {!! Form::close() !!}
            </div>

        </div>

    </div>
@endsection

<script>

    var zonesDistrict = {!! json_encode($zonesDistrict) !!};

</script>