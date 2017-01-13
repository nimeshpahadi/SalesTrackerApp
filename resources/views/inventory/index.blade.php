@extends('Layout.app')

@section('main-content')
    <div class="col-md-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div align="right">
                <a href="{{route('stockin')}}">
                    <span class=" btn btn-primary">View StocksIn</span>
                </a>
                <a href="{{route('stockout')}}">
                    <span class=" btn btn-primary">View StockOut</span>
                </a>
               {{--         @role(('factoryincharge'))
                        <a href="{{route('stock.create')}}">
                            <span class=" btn btn-success glyphicon glyphicon-plus"> Stocks_In</span>
                        </a>
                        @endrole--}}

            </div>


            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12 ">
                    @if(isset($stocks))
                    @foreach($stocks as $ware=>$value)

                        <div class="box box-primary">

                            <h3>{{$ware}}</h3>

                            @role((['admin','factoryincharge','generalmanager','director', 'accountmanagersales', 'salesmanager']))
                            <a href="{{route('orderwarehouse',['warehouse_id'=>$value['ware_id']])}}">
                                <span class=" btn btn-success">Order</span>
                            </a>
                            @endrole
                            <table class="table table-bordered table-responsive">

                                <tr>
                                    <th align="center">Product Type</th>
                                    <th align="center">Product Stocks In</th>
                                    <th align="center">Product Stocks Out</th>
                                    <th align="center">Product Remaining</th>
                                    <th> Action</th>
                                </tr>

                                @if(isset($value['product'] ))
                                @foreach($value['product'] as $prodCat=>$stock)
                                    <tr>
                                        <td align="center">{{$prodCat}}</td>
                                        <td align="center">{{$stock['in']}}</td>
                                        <td align="center">{{$stock['out']}}</td>
                                        <td align="center">{{$stock['in']-$stock['out']}}</td>
                                        <td>
                                            @role(('factoryincharge'))
                                            <button class=" btn btn-primary glyphicon glyphicon-plus"
                                                    data-toggle="modal"
                                                    data-target="#price{{$value['ware_id']}}{{$stock['pid']}}">Stock
                                            </button>
                                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                                 id="price{{$value['ware_id']}}{{$stock['pid']}}"
                                                 aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">

                                                        {!! Form::open(array('route' => 'stock.store'))!!}
                                                        <h3>{{$ware}}--{{$prodCat}}</h3>
                                                        <div class="form-group ">

                                                            <input type="number" name="product_id" hidden
                                                                   value="{{$stock['pid']}}">
                                                            <input type="number" name="warehouse_id" hidden
                                                                   value="{{$value['ware_id']}}">
                                                            <input name="created_by" hidden
                                                                   value='{{ Auth::user()->username }}'>
                                                            <div class=" col-md-10   col-md-offset-1 clearfix"
                                                                 style="padding: 10px">
                                                                <input type="number" class="form-control "
                                                                       name="quantity" required
                                                                       placeholder="Enter the Stock Quantity">
                                                            </div>

                                                        </div>

                                                        {{Form::submit('Save Stock', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
                                                        <a type="button" class="btn btn-warning btn-block"
                                                           href="/stock">Cancel</a>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                            @endrole

                                            <a href="{{route('stockinHistory',['product_id'=>$stock['pid'],'warehouse_id'=>$value['ware_id']])}}">
                                                <span class=" btn btn-success">Stockin History</span>
                                            </a>
                                            <a href="{{route('stockoutHistory',['product_id'=>$stock['pid'],'warehouse_id'=>$value['ware_id']])}}">
                                                <span class=" btn btn-success">Stockout History</span>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                                    @endif
                            </table>
                        </div>
                    @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>

@endsection
