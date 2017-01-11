@extends('Layout.app')

@section('main-content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of Stocks In</h3>
        </div>
        <div align="right">

            <a href="{{route('stock.create')}}">
                <span class=" btn btn-success glyphicon glyphicon-plus">Stocks_In</span>
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Warehouse Name</th>
                    <th>Product Subcategory Name</th>
                    <th>Quantity(s)</th>
                    <th>Added By</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>


                </tr>
                </thead>
                <tbody>

                @foreach($ware_name as $as)
                    <tr>
                        <td>{{$as->warehouse_name}}</td>
                        <td>{{$as->product_subcatname}}</td>
                        <td>{{$as->quantity}}</td>
                        <td>{{$as->created_by}}</td>
                        <td>{{$as->created_at}}</td>
                        <td>{{$as->updated_at}}</td>
                        <td><a href="{!! route('stock.edit',$as->id)!!}">
                                <span class="  btn btn-primary glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>















@endsection
