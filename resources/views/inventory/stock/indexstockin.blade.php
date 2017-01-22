@extends('Layout.app')

@section('main-content')


    <div class="box pad">
        <div class="box-header">
            <h3 class="box-title">List of Stocks In</h3>
        </div>
        <div align="right">


        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th align="center">Quantity(s)</th>
                    <th>Added By</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>

                </tr>
                </thead>
                <tbody>

                @foreach($ware_name as $as)
                    <tr>

                        <td align="center">{{$as->quantity}}</td>
                        <td>{{$as->created_by}}</td>
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
