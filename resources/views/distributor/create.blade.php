@role((['admin', 'salesmanager', 'accountmanagersales', 'salesman', 'director', 'generalmanager']))
@extends('Layout.app')

@section('main-content')



    <?php

    $zonesDistrict = config('distributor.district');

    ?>
<div class="col-md-10 col-md-offset-1">

    <h3>Create Customer</h3>
    <div class="box box-info clearfix ">


        {!! Form::open(array('id'=>'form','route'=>'distributor.store'))!!}


        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }} clearfix">
            <label for="company_name" class="col-sm-4 control-label">Company Name</label>

            <div class="col-sm-8">
                <input id="company_name" type="text" class="form-control" name="company_name"
                       value="{{ old('company_name') }}" required autofocus>

                @if ($errors->has('company_name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }} clearfix">
            <label for="contact_name" class="col-sm-4 control-label">Owner Name</label>

            <div class="col-sm-8">
                <input id="contact_name" type="text" class="form-control" name="contact_name"
                       value="{{ old('contact_name') }}" required autofocus>

                @if ($errors->has('contact_name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} clearfix">
            <label for="email" class="col-sm-4 control-label">Email</label>

            <div class="col-sm-8">
                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required
                       autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} clearfix">
            <label for="phone" class="col-sm-4 control-label">Phone</label>

            <div class="col-sm-8">
                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required
                       autofocus>

                @if ($errors->has('phone'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('open_date') ? ' has-error' : '' }} clearfix">
            <label for="mobile" class="col-sm-4 control-label">Mobile</label>

            <div class="col-sm-8">
                <input id="mobile" type="number" class="form-control" name="mobile" value="{{ old('mobile') }}" required
                       autofocus>

                @if ($errors->has('mobile'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

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


        <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }} clearfix">
            <label for="latitude" class="col-sm-4 control-label">Latitude</label>

            <div class="col-sm-8">
                <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude') }}"
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
                <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude') }}"
                       required autofocus>

                @if ($errors->has('longitude'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('open_date') ? ' has-error' : '' }} clearfix">
            <label for="open_date" class="col-sm-4 control-label">Open Date</label>

            <div class="col-sm-8">
                <input id="open_date" type="date" class="form-control" name="open_date" value="{{ old('open_date') }}"
                       required autofocus>

                @if ($errors->has('open_date'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('open_date') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group clearfix">
            <label for="lead_source" class="col-sm-4 control-label">Lead Source</label>
            <div class="col-md-8">
                <?php $x = Config::get('distributor.lead_source');?>
                <select name="lead_source" class="form-control" required>
                    <option selected="selected" value="" disabled>Choose Lead Source</option>
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
                <select name="type" class="form-control" required>
                    <option selected="selected" value="" disabled>Choose Distributor Type</option>
                    @foreach($x as $dep)
                        <option value=" {{ $dep}}">
                            {{ $dep  }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group{{ $errors->has('vat_no') ? ' has-error' : '' }} clearfix">
            <label for="vat_no" class="col-sm-4 control-label">Vat/Pan number</label>

            <div class="col-sm-8">
                <input id="vat_no" type="text" class="form-control" name="vat_no" value="{{ old('vat_no') }}"
                       autofocus>

                @if ($errors->has('vat_no'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('vat_no') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group clearfix">
            <label for="status" class="col-sm-4 control-label">Status</label>
            <div class="col-md-8">
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio1" value="1" checked="checked">Active
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio2" value="0"> Inactive
                </label>
            </div>
        </div>
        <div class="clearfix"></div>

        <div align="center" class="col-md-4 col-md-offset-4 ">
            <div class="row">
                {{Form::submit('Create Distributor', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
                <a type="button" class="btn btn-warning btn-block" href="/distributor">Cancel</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>

        <script>

            var zonesDistrict = {!! json_encode($zonesDistrict) !!};

        </script>

@endsection
@endrole