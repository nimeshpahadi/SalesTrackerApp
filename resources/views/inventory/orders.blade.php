@extends('Layout.app')

@section('main-content')


    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @role((['admin','factoryincharge']))

                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>Send Date</th>
                                <th>Distributor</th>
                                <th>Product Name</th>
                                <th>Order-Out By</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ware_order as $o)


                                <tr>

                                    <td>{{$o->senddate}}</td>
                                    <td><a href="/distributor/{{$o->dis_id}} ">{{$o->distributor}}</a></td>

                                    <td>{{$o->productname}}</td>
                                    <td>{{$o->username}}</td>


                                    <td>


                                        <a href="{{route('order.show',['orderid'=>$o->order_id])}}">
                                            <span class=" btn btn-success">View</span>
                                        </a>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>


                </div>
                @endrole
            </div>
        </div>

    </section>
@endsection
