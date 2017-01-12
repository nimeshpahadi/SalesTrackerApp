@extends('Layout.app')

@section('main-content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of Stocks Out</h3>
        </div>
        <div align="right">


        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th align="center">Customer</th>
                    <th align="center">Quantity(s)</th>
                    <th>Dispatched By</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>

                </tr>
                </thead>
                <tbody>

                @foreach($ware_name as $as)
                    <tr>

                        <td >{{$as->customername}}</td>
                        <td >{{$as->quantity}}</td>
                        <td>{{$as->username}}</td>
                        <td>{{$as->created_at}}</td>
                        <td>{{$as->updated_at}}</td>


                    </tr>

                @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>















@endsection
