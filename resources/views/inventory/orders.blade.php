@extends('Layout.app')

@section('main-content')


{{--{{$ware_order}}--}}
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

                {{--<th>Order Id</th>--}}
                <th>Send date</th>
                <th>Distributor</th>
                {{--<th>Shipping Address</th>
                <th>City</th>
                <th>Location</th>--}}
                <th>Product Name</th>
                <th>Order-out by</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($ware_order as $o)


                <tr>

                    {{--<td><a href="/order/{{$o->order_id}} ">{{$o->order_id}}</a></td>--}}
                    <td>{{$o->senddate}}</td>
                    <td><a href="/distributor/{{$o->dis_id}} ">{{$o->distributor}}</a></td>
                    {{--<td>{{$o->Dzone}}:{{$o->Ddistrict}}</td>--}}
                    {{--<td>{{$o->Dcity}}</td>--}}
                    {{--<td>lat:{{$o->lat}}long:{{$o->lat}}</td>--}}
                    <td>{{$o->productname}}</td>
                    <td>{{$o->username}}</td>


                    <td>


                        {{--@foreach($dispatched as $dis)--}}
                            {{--@role(('factoryincharge'|'admin'))--}}
                        {{--@if(($dis->orderid != $o->order_id) )--}}
                            {{--{!! Form::open(array('route' => 'dispatch','method'=>'post'))!!}--}}
                            {{--{{ Form::hidden('dispatched_by',  Auth::user()->id) }}--}}
                            {{--{{ Form::hidden('order_out_id', $o->id) }}--}}


                            {{--{{Form::submit('Dispatch', array('class'=>'btn btn-primary'))}}--}}
                            {{--{!! Form::close() !!}--}}
                        {{--@endif--}}
                        {{--@endrole--}}


                            {{--@if(count($dispatched)>0 && $dis->orderid ==$o->order_id)--}}
                                <a href="{{route('order.show',['orderid'=>$o->order_id])}}">
                                    <span class=" btn btn-success">View</span>
                                </a>

                            {{--@endif--}}
                            {{--@endforeach--}}

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
