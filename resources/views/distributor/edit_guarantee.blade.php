@extends('Layout.app')

@section('main-content')


    <h3>Edit Guarantee</h3>
    <div class="col-md-7">
        <div class="box box-info clearfix ">

            {!! Form::model($dist,array('route'=>['guarantee_update',$dist->id],'method'=>'PUT'))!!}

            <div class="form-group clearfix">
                <label for="type" class="col-sm-4 control-label">Type</label>
                <div class="col-md-8">
                    <select id="select" name="type" class="form-control" required>
                        <option>{{$guarantee->type}}</option>
                        <option value="Bank">Bank</option>
                        <option value="Pdp">Pdp</option>
                        <option value="Cash">Cash</option>
                        <option value="Collateral">Collateral</option>
                        <option value="Others">Others</option>

                    </select>

                </div>

            </div>

            <div class="form-group clearfix" id="bank_name">
                <label for="type" id="bank_name" class="col-sm-4 control-label bank-name">Bank Name</label>
                <div class="col-md-8">
                    {{ Form::text('bank_name',$guarantee->bank_name,array('class'=>'"col-sm-8 form-control bank-name'))}}
                </div>
            </div>

            <div class="form-group clearfix" id="cheque_no">
                <label for="type" id="cheque_no" class="col-sm-4 control-label cheque-no">Cheque No</label>
                <div class="col-md-8">
                    {{ Form::text('cheque_no',$guarantee->cheque_no,array('class'=>'"col-sm-8 form-control cheque-no'))}}
                </div>
            </div>

            {{ Form::hidden('distributor_id', $dist->id) }}

            <div class="form-group clearfix" id="amount">
                <label for="amount" class="col-sm-4 control-label amount">Amount</label>
                <div class="col-md-8">
                    {{ Form::text('amount',$guarantee->amount,array('class'=>'col-sm-8 form-control amount','min'=>'0'))}}
                </div>
            </div>

            <div class="form-group clearfix" id="remark">
                <label for="type" class="col-sm-4 control-label">Remark</label>
                <div class="col-md-8">
                    {{ Form::textarea('remark',$guarantee->remark,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>

            <div align="right">
                {{Form::submit('Save Changes', array('class'=>'btn btn-primary'))}}
                <a type="button" class="btn btn-warning " href="{{ URL::previous() }}">Cancel</a>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

    <script>
        var editGuarantee=true;
        var guaranteeType = '{{$guarantee->type}}';
    </script>


@endsection
