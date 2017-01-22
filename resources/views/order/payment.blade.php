@extends('Layout.app')

@section('main-content')

    <div class="col-md-6 col-md-offset-3 ">

    <h3>Add Payment</h3>
        <div class="box box-info clearfix pad">
            {!! Form::open(array('route' => 'add_order_payment'))!!}


        <div class="form-group clearfix" id="type">
            <label for="type" class="col-sm-4 control-label">Type</label>
            <div class="col-md-8">
                <?php $x = Config::get('distributor.payment_type');?>
                <select id="type" name="type" class="form-control" required>
                    <option selected="selected" value="" disabled>Choose Payment Type</option>
                    @foreach($x as $dep)
                        <option value="{{$dep}}">
                            {{ $dep  }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group clearfix">
            <label for="amount" class="col-sm-4 control-label">Amount</label>
            <div class="col-sm-8">
                <input type="number" name="amount" min=0 class="form-control" required
                       placeholder="enter amount received" >
            </div>
        </div>

        <div class="form-group clearfix" id="bankname">
            <label class="col-sm-4 control-label">Bank Name</label>
            <div class="col-sm-8">
                <input  id="bankname" type="text" name="bank_name"  class="form-control" >
            </div>
        </div>
        <div class="form-group clearfix" id="chequeno">
            <label class="col-sm-4 control-label">Cheque No.</label>
            <div class="col-sm-8">
                <input  id="chequeno" type="text" name="cheque_no"  class="form-control" >
            </div>
        </div>
        <div class="form-group clearfix"  id="chequedate">
            <label class="col-sm-4 control-label">Cheque Due Date</label>
            <div class="col-sm-8">
                <input   id="date" type="text" name="cheque_date"  class="form-control" >
            </div>
        </div>


        <div class="form-group clearfix">
            <label class="col-sm-4 control-label">Remark</label>
            <div class="col-sm-8">
                <textarea type="number" name="remark" class="form-control">
            </textarea></div>
        </div>

        {{--</input>--}}
        <input name="user_id" hidden value='{{ Auth::user()->id }}'>
        <input name="distributor_id" hidden value='{{$id}}'>


    </div>
    <div align="right" class="pad">
        {{Form::submit('Save ', array('class'=>'btn btn-primary'))}}
        <a type="button" class="btn btn-warning"
           href="{{ URL::previous() }}">Cancel</a>
        {!! Form::close() !!}

    </div>
    </div>

@endsection