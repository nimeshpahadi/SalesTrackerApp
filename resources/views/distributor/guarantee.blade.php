@role((['admin','salesmanager','generalmanager','accountmanagersales','director']))
@extends('Layout.app')

@section('main-content')


    <h3>Create Guarantee</h3>
    <div class="box box-info clearfix ">

        {!! Form::open(array('route' => 'guarantee_store'))!!}

        <div class="form-group clearfix">
            <label for="type" class="col-sm-4 control-label">Type</label>
            <div class="col-md-4">
                <select id="select" name="type" class="form-control" required>
                    <option selected="selected" value="" disabled>Choose Guarantee Type</option>
                    <option value="Bank" >Bank</option>
                    <option value="Pdp" >Pdp</option>
                    <option value="Cash" >Cash</option>
                    <option value="Collateral" >Collateral</option>
                    <option value="Others" >Others</option>

                </select>

            </div>

        </div>

        <div class="form-group clearfix" id="bank_name">
            <label for="type" class="col-sm-4 control-label">Bank name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control bank-name" name="bank_name" value="{{ old('bank_name') }}">
            </div>
        </div>

        <div class="form-group clearfix" id="cheque_no">
            <label for="type" class="col-sm-4 control-label">Cheque no</label>
            <div class="col-sm-4">
                <input type="text" class="form-control cheque-no" name="cheque_no" value="{{ old('cheque_no') }}">
            </div>
        </div>

        {{ Form::hidden('distributor_id', $disid->id) }}

        <div id="amount" class="form-group{{ $errors->has('amount') ? ' has-error' : '' }} clearfix">
            <label for="amount" class="col-sm-4 control-label">Amount</label>

            <div class="col-sm-4">
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
            <div class="col-sm-8">
                {{ Form::textarea('remark', null, ['size' => '50x5']) }}
            </div>
        </div>


        <div  align="right">
        {{Form::submit('Create Guarentee', array('class'=>'btn btn-primary'))}}
        <a type="button" class="btn btn-warning " href="/distributor/{{ $disid->id }}">Cancel</a>
        {!! Form::close() !!}
        </div>

    </div>

@endsection
@endrole