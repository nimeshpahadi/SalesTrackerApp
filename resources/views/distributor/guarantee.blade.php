@role((['admin','salesmanager','generalmanager','accountmanagersales','director']))
@extends('Layout.app')

@section('main-content')


    <div class="col-md-6 col-md-offset-3">
        <h3>Create Guarantee</h3>

        <div class="box box-info clearfix ">

        {!! Form::open(array('route' => 'guarantee_store'))!!}

        <div class="form-group clearfix pad-top">
            <label for="type" class="col-sm-4 control-label ">Type</label>
            <div class="col-md-8">
                <select id="select" name="type" class="form-control" required>
                    <option selected="selected" value="" disabled>Choose Guarantee Type</option>
                    <option value="Bank" >Bank Guarantee</option>
                    <option value="Cash" >Cash</option>
                    <option value="Collateral" >Collateral</option>
                    <option value="Others" >Others</option>
                    <option value="Pdp" >Pdc</option>

                </select>

            </div>

        </div>

        <div class="form-group clearfix" id="bank_name">
            <label for="type" class="col-sm-4 control-label">Bank name</label>
            <div class="col-md-8">
                <input type="text" class="form-control bank-name" name="bank_name" value="{{ old('bank_name') }}">
            </div>
        </div>

        <div class="form-group clearfix" id="cheque_no">
            <label for="type" class="col-sm-4 control-label">Cheque no</label>
            <div class="col-md-8">
                <input type="text" class="form-control cheque-no" name="cheque_no" value="{{ old('cheque_no') }}">
            </div>
        </div>

        {{ Form::hidden('distributor_id', $disid->id) }}

        <div id="amount" class="form-group{{ $errors->has('amount') ? ' has-error' : '' }} clearfix">
            <label for="amount" class="col-sm-4 control-label">Amount</label>

            <div class="col-md-8">
                <input id="amount" type="text"  class="form-control amount" name="amount" min=0  value="{{ old('amount') }}">
                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group clearfix">
            <label for="type" class="col-sm-4 control-label">Remark</label>
            <div class="col-md-8">
                <textarea class="col-md-12 " name="remark">
                </textarea>
            </div>
        </div>


        <div class="pad" align="right">
        {{Form::submit('Create', array('class'=>'btn btn-primary','title'=>'Create the guarantee '))}}
        <a type="button" class="btn btn-warning " href="/distributor/{{ $disid->id }}">Cancel</a>
        {!! Form::close() !!}
        </div>

    </div>
    </div>

@endsection
@endrole