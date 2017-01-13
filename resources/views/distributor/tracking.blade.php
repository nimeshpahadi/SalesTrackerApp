@extends('Layout.app')

@section('main-content')

    <div class="col-md-6 ">


        <h3>Add Distributor Visit</h3>
        <div class="box box-info clearfix ">


            {!! Form::open(array('route' => 'tracking_store'))!!}


            {{ Form::hidden('distributor_id', $disid->id) }}
            {{ Form::hidden('user_id', Auth::user()->id) }}
            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Stage</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.tracking_stage');?>
                    <select name="stage" class="form-control" required>
                        <option selected="selected" value="" disabled>Choose Tracking Stage</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="business_probability" class="col-sm-4 control-label">Business Probability</label>
                <div class="col-sm-8">
                    <input type="number" name="business_probability" required max="100" class="form-control"
                           placeholder="in percentage(%)" %>
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Activity</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.tracking_activity');?>
                    <select name="activity" class="form-control" required>
                        <option selected="selected" value="" disabled>Choose Tracking Activity</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Loss Reason</label>
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.tracking_loss_reason');?>
                    <select name="loss_reason" class="form-control" required>
                        <option selected="selected" value="" disabled>Choose Tracking Loss Reason</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>
            {{Form::submit('Save Tracking', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
            <a type="button" class="btn btn-warning btn-block" href="/distributor/{{$disid->id}}">Cancel</a>
            {!! Form::close() !!}


        </div>

    </div>

@endsection