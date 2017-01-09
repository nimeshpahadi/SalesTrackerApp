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
                        @foreach($guarantee as $g)
                            <option selected="selected" disabled>{{$g->type}}</option>
                        @endforeach
                        <option value="Bank">Bank</option>
                        <option value="Pdp">Pdp</option>
                        <option value="Cash">Cash</option>
                        <option value="Collateral">Collateral</option>
                        <option value="Others">Others</option>

                    </select>

                </div>

            </div>
            <div class="form-group clearfix" id="bank_name">
                <label for="type" id="bank_name" class="col-sm-4 control-label bank-name">Bank name</label>
                <div class="col-md-8">
                    {{ Form::text('bank_name',$g->bank_name,array('class'=>'"col-sm-8 form-control bank-name'))}}
                </div>
            </div>

            <div class="form-group clearfix" id="cheque_no">
                <label for="type" id="cheque_no" class="col-sm-4 control-label cheque-no">Cheque no</label>
                <div class="col-md-8">
                    {{ Form::text('cheque_no',$g->cheque_no,array('class'=>'"col-sm-8 form-control cheque-no'))}}
                </div>
            </div>

            {{ Form::hidden('distributor_id', $dist->id) }}

            <div class="form-group clearfix" id="amount">
                <label for="amount" class="col-sm-4 control-label amount">Amount</label>
                <div class="col-md-8">
                    {{ Form::text('amount',$g->amount,array('class'=>'col-sm-8 form-control amount','min'=>'0'))}}
                </div>
            </div>
            <div class="form-group clearfix" id="remark">
                <label for="type" class="col-sm-4 control-label">Remark</label>
                <div class="col-md-8">
                    {{ Form::textarea('remark',$g->remark,array('class'=>'"col-sm-8 form-control'))}}
                </div>
            </div>

            <div align="right">
                {{Form::submit('Save Changes', array('class'=>'btn btn-primary'))}}
                <a type="button" class="btn btn-warning " href="/distributor">Cancel</a>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection











{{--{!! Form::open(array('route' => 'guarantee_store'))!!}--}}
{{--        {!! Form::model($dist,array('route' => 'guarantee_update'),$dist->id !!}--}}
