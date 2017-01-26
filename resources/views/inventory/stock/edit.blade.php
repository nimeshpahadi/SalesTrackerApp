@extends('Layout.app')

@section('main-content')
<div class="col-md-6 col-md-offset-3">
    <h3>Edit Stocks</h3>
    <div class="box box-info clearfix pad ">

        @foreach($ware_name as $w)
        @endforeach
        {!! Form::model($stockin,array('route'=>['stock.update',$stockin->id],'method'=>'PUT' ))!!}
        <div class="form-group clearfix">
            <label for="zone" class="col-sm-4 control-label">Warehouse</label>
            <div class="col-md-8">
                <select class="form-control zones-dropdown" required name="warehouse_id">
                    <option selected="selected" value="{{ $w->ware_id}}">{{$w->warehouse_name}}</option>
                    @foreach($warehouse as $dep)
                        <option value=" {{ $dep->id}}">
                            {{ $dep->name}}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>

        <div class="form-group clearfix">
            <label for="product" class="col-sm-4 control-label">Product</label>
            <div class="col-md-8">
                <select class="form-control zones-dropdown" required name="product_id">
                    <option selected="selected" value="{{$w->prod_id}}">{{$w->product_subcatname}}</option>
                    @foreach($product as $dep)
                        <option value=" {{ $dep->id}}">
                            {{ $dep->sub_category  }}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>
        <input name="created_by" hidden value= {{ Auth::user()->username }}>

        <div class="form-group clearfix">
            <label for="company_name" class="col-sm-4 control-label">Quantity</label>
            <div class="col-sm-8">
                {{ Form::text('quantity',null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="clearfix" align="center">
        {{Form::submit('Save Changes', array('class'=>'btn btn-primary','title'=>'Save changes to the Stockin'))}}
        <a type="button" class="btn btn-warning " href="/stockin">Cancel</a>
        {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection