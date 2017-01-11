@extends('Layout.app')

@section('main-content')

    <h3>Create Stocks</h3>
    <div class="box box-info clearfix ">

        {!! Form::open(array('id'=>'form','route'=>'stock.store'))!!}
        <div class="form-group clearfix">
            <label for="zone" class="col-sm-4 control-label">Warehouse</label>
            <div class="col-md-8">
                <select class="form-control zones-dropdown" required name="warehouse_id">
                    <option selected="selected" value="" disabled>Choose Warehouse</option>
                    @foreach($ware as $dep)
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
                    <option selected="selected" value="" disabled>Choose Sub-Category</option>
                    @foreach($subcat as $dep)
                        <option value="{{$dep->id}}">
                            {{ $dep->sub_category  }}{{$dep->id}}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>

        <input name="created_by" hidden value='{{ Auth::user()->username }}'>

        <div class="form-group clearfix">
            <label for="company_name" class="col-sm-4 control-label">Quantity</label>
            <div class="col-sm-8">
                <input type="number" name="quantity" class="form-control" required>
            </div>
        </div>


        <div class="clearfix"></div>
        <div align="center" class="col-md-4 col-md-offset-4">
            {{Form::submit('Add stock', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
            <a type="button" class="btn btn-warning btn-block" href="/stock">Cancel</a>
            {!! Form::close() !!}
        </div>

    </div>

@endsection
