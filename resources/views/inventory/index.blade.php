@extends('Layout.app')

@section('main-content')
    <div class="col-md-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div align="right" class="pad-right">
                <a href="{{route('stockin')}}">
                    <span class=" btn btn-sm btn-primary" title="View all the stock in all warehouse">View StocksIn</span>
                </a>
                <a href="{{route('stockout')}}">
                    <span class=" btn  btn-sm btn-primary" title="View all the stock out from all warehouse">View StockOut</span>
                </a>


            </div>


            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12 ">
                    @if(isset($stocks))
                    @foreach($stocks as $ware=>$value)

                        <div class="box box-primary">

                            @role((['admin','factoryincharge','generalmanager','director', 'accountmanagersales', 'salesmanager']))

                                <div class="col-md-11 ">
                                <h3 align="left">{{$ware}}</h3>
                                </div>
                                <div class="col-md-offset-1 pad-top" >
                            <a href="{{route('orderwarehouse',['warehouse_id'=>$value['ware_id']])}}">
                                <span class=" btn btn-warning "  title="View order in {{$ware}}">Order</span>
                            </a>
                                </div>

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

                                        <td align="center">{{--{{$stock['in']-$stock['out']}}--}}
                                            @if($stock['in']>$stock['out'] )
                                            {{$stock['in']-$stock['out']}}
                                        @else
                                       Production inprocess
                                        @endif
                                        </td>
                                        <td>
                                            @role(('factoryincharge'))
                                            <button class=" btn  btn-sm btn-primary glyphicon glyphicon-plus" title="Add the Stock for {{$ware}}"
                                                    data-toggle="modal"
                                                    data-target="#price{{$value['ware_id']}}{{$stock['pid']}}">Stock
                                            </button>
                                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                                 id="price{{$value['ware_id']}}{{$stock['pid']}}"
                                                 aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content pad">

                                                        {!! Form::open(array('route' => 'stock.store'))!!}
                                                        <h3>{{$ware}}--{{$prodCat}}</h3>
                                                        <div class="form-group ">

                                                            <input type="number" name="product_id" hidden
                                                                   value="{{$stock['pid']}}">
                                                            <input type="number" name="warehouse_id" hidden
                                                                   value="{{$value['ware_id']}}">
                                                            <input name="created_by" hidden
                                                                   value='{{ Auth::user()->username }}'>
                                                            <div class="pad clearfix"
                                                                >
                                                                <input type="number" class="form-control "
                                                                       name="quantity" required
                                                                       placeholder="Enter the Stock Quantity">
                                                            </div>

                                                        </div>
                                                        <div align="right">
                                                        {{Form::submit('Save Stock', array('class'=>'btn btn-primary ','title'=>"Add stock in {$ware}"))}}
                                                        <a type="button" class="btn btn-warning "
                                                           href="/stock">Cancel</a>
                                                        {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endrole

                                            <a href="{{route('stockinHistory',['product_id'=>$stock['pid'],'warehouse_id'=>$value['ware_id']])}}">
                                                <span class=" btn btn-sm btn-success" title="View Stockin history for {{$prodCat}} product {{$ware}}">Stockin History</span>
                                            </a>
                                            <a href="{{route('stockoutHistory',['product_id'=>$stock['pid'],'warehouse_id'=>$value['ware_id']])}}">
                                                <span class=" btn btn-sm btn-success" title="View Stockout history for {{$prodCat}} product {{$ware}}">Stockout History</span>
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
