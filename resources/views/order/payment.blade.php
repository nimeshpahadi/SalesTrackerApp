@extends('Layout.app')

@section('main-content')

    {!! Form::open(array('route' => 'add_order_payment'))!!}
    <h3>Add Payment</h3>
    <div class="form-group col-md-12">


        <div class="form-group clearfix">
            <label for="amount" class="col-sm-4 control-label">Amount</label>
            <div class="col-sm-8">
                <input type="number" name="amount" min=0 class="form-control" required
                       placeholder="enter amount received" required>
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="type" class="col-sm-4 control-label">Type</label>
            <div class="col-md-8">
                <?php $x = Config::get('distributor.guarantee_type');?>
                <select name="type" class="form-control" required>
                    <option selected="selected" value="" disabled>Choose Payment Type</option>
                    @foreach($x as $dep)
                        <option value="{{ $dep}}">
                            {{ $dep  }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--</input>--}}
        <input name="user_id" hidden value='{{ Auth::user()->id }}'>
        <input name="distributor_id" hidden value='{{$orderId->id}}'>


    </div>
    <div align="right" style="padding: 10px">
        {{Form::submit('Save ', array('class'=>'btn btn-primary'))}}
        <a type="button" class="btn btn-warning"
           href="{{ URL::previous() }}">Cancel</a>
        {!! Form::close() !!}

    </div>

@endsection