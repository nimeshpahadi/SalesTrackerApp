@extends('Layout.app')

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info col-md-10">
                    <div class="panel-heading"><h4>SMS Details</h4></div>


                    {!! Form::open(array('id'=>'sms','route'=>'sms'))!!}

                    {{ Form::hidden('order_id', $orderId->id) }}

                    @foreach($distId as $d)

                        <div class="form-group clearfix pad-top">
                            <label for="vat" class="col-sm-4 control-label">Send to:</label>
                            <input class="col-md-8" type="text" name="send_to"

                                   value="{{$d->mobile}},{{$shipaddress->mobile}},
                                            @if(isset($billingaddress->mobile)){{$billingaddress->mobile}}  @endif"
                                   required>
                        </div>

                        <div class="form-group ">
                            <label for="sms" class="col-sm-4 control-label">TEXT SMS</label>
                            <textarea class="col-md-8" name="sms" style="height: 150px">{{$d->company_name}}&#13Quantity: {{$orderId->quantity}} &#13Driver: {{$dispatched->driver_name}},{{$dispatched->driver_contact}}. &#13Vehicle No.: {{$dispatched->vehicle_no}}&#13Dispatched Date:{{($dispatched->created_at)}}</textarea>
                        </div>


                        <div align="center" class="col-md-2 col-md-offset-10 pad ">
                            <div class="row">

                                @endforeach
                                {{Form::submit('Send SMS', array('class'=>'btn btn-primary', 'title'=>"send sms"))}}

                                {!! Form::close() !!}
                            </div>
                        </div>

                </div>

            </div>
        </div>

    </section>
@endsection


