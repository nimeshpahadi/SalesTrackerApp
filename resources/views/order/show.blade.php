@extends('Layout.app')

@section('main-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">


                <div class="panel panel-info col-md-8">
                    <div class="panel-heading"><h3>Order Details</h3></div>

                    <div class="panel-body"><h1 align="center">{{$orderId->distributor_name}}</h1>
                    </div>

                    <div class="row">
                        <label class="col-sm-6 "> Quantity :</label>
                        {{$orderId->quantity}}
                    </div>
                    <div class="row">
                        <label class="col-sm-6 "> Price/Sack :</label>
                        Rs. {{number_format($orderId->price, 2)}}
                    </div>
                    <div class="row">
                        <label class="col-sm-6 "> Gross Price :</label>
                        Rs. {{number_format($orderId->price * $orderId->quantity, 2)}}
                    </div>
                    <div class="row">
                        <label class="col-sm-6 "> Salesman :</label>
                        {{$orderId->userName}}
                    </div>
                    <div class="row">
                        <label class="col-sm-6 "> Customer :</label>
                        {{$orderId->distributor_name}}
                    </div>
                    <div class="row">
                        <label class="col-sm-6 "> Ordered Date :</label>
                        {{$orderId->created_at}}
                    </div>

                    <div class="row">
                        <label class="col-sm-6 "> Delivery Date :</label>
                        {{$orderId->proposed_delivery_date}}
                    </div>

                    <hr>

                    <div class="">

                        <h4> Order Billing</h4>
                        @role((['admin', 'gm', 'salesmanager', 'accountmanagersales', 'director']))
                        <div align="right">
                            <a href="{{route('create_payment',$orderId->distributor_id)}}">
                                <span class=" btn btn-success glyphicon glyphicon-plus"> payment</span>
                            </a>
                        </div>
                        @endrole
                    </div>
                    @foreach($order_billings as $ob)

                        <div class="row">
                            <label class="col-sm-6 "> Discount :</label>
                            {{$ob->discount}}%
                        </div>

                        <div class="row">
                            <label class="col-sm-6 "> Vat :</label>
                            {{$ob->vat}}%
                        </div>
                        <div class="row">
                            <label class="col-sm-6 "> Shipping Charge :</label>
                            Rs. {{number_format($ob->shipping_charge, 2)}}
                        </div>
                        <div class="row">
                            <label class="col-sm-6 "> Grand Total :</label>
                            Rs. {{number_format($ob->grand_total, 2)}}
                        </div>
                        <div class="row">
                            <label class="col-sm-6 "> Created At :</label>
                            {{$ob->created_at}}
                        </div>

                        <hr>

                    @endforeach

                    <div class="col-md-12">
                        @if(isset($orderout->orderoutid)&& !isset($dispatched->orderoutid))
                            @role((['factoryincharge']))
                            <div align="right">
                                {!! Form::open(array('route' => 'dispatch','method'=>'post'))!!}
                                {{ Form::hidden('dispatched_by',  Auth::user()->id) }}
                                {{ Form::hidden('order_out_id', $orderout->orderoutid) }}
                                {{ Form::hidden('quantity', $orderout->qty) }}

                                {{Form::submit('Dispatch', array('class'=>'btn btn-primary'))}}
                                {!! Form::close() !!}

                            </div>
                            @endrole
                        @endif


                        @if(isset($dispatched->orderoutid) && $dispatched->orderid==$orderId->id)
                            <div class="panel panel-success ">
                                <div class="panel-heading"><h3>Order Already Dispatched</h3></div>

                                <div class="row">
                                    <label class="col-sm-6 "> Dispatched By :</label>
                                    {{$dispatched->username}}
                                </div>

                                <div class="row">
                                    <label class="col-sm-6 "> Dispatched On :</label>
                                    {{$dispatched->created_at}}
                                </div>

                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-md-4 ">
                    @role((['admin','salesmanager', 'generalmanager', 'director']))

                    @if(count($order_billings)<1)

                        <div class="box box-info clearfix ">

                            <h3> Order Billing</h3>
                            {!! Form::open(array('id'=>'orderbilling','route'=>'add_order_billing'))!!}

                            {{ Form::hidden('user_id', Auth::user()->id) }}

                            {{ Form::hidden('order_id', $orderId->id) }}

                            <div class="form-group{{ $errors->has('total_price') ? ' has-error' : '' }} clearfix">
                                <label for="total_price" class="col-sm-4 control-label">Total Price</label>

                                <div class="col-sm-8">

                                    <input type="text" name="total_price"
                                           value="{{$orderId->price * $orderId->quantity}}" readonly
                                           id="textone">
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }} clearfix">
                                <label for="discount" class="col-sm-4 control-label">Discount</label>

                                <div class="col-sm-8">
                                    <input type="text" name="discount" id="texttwo" placeholder="in %" required>


                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }} clearfix">
                                <label for="vat" class="col-sm-4 control-label"><VAT></VAT></label>

                                <div class="col-sm-8">
                                    <input type="text" name="vat" id="textthree" placeholder="in %" required>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('shipping_charge') ? ' has-error' : '' }} clearfix">
                                <label for="shipping_charge" class="col-sm-4 control-label">Shipping Charge</label>

                                <div class="col-sm-8">
                                    <input type="text" name="shipping_charge" id="textfour" required>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('grand_total') ? ' has-error' : '' }} clearfix">
                                <label for="grand_total" class="col-sm-4 control-label">Grand Total</label>

                                <div class="col-sm-8">
                                    <input type="text" name="grand_total" id="result" readonly>
                                </div>
                            </div>
                            <div align="center" class="col-md-2 col-md-offset-4 ">
                                <div class="row">
                                    {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    @endif

                    @endrole

                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

                    <script>
                        $('#textfour,#textthree,#texttwo').keyup(function () {
                            var textone;
                            var texttwo;
                            var textthree;
                            var textfour;
                            textone = parseFloat($('#textone').val());
                            texttwo = parseFloat($('#texttwo').val());
                            textthree = parseFloat($('#textthree').val());
                            textfour = parseFloat($('#textfour').val());
                            var total = (textone - (texttwo * textone) / 100);
                            var result = (total + (textthree * total) / 100) + textfour;
                            $('#result').val(result.toFixed(2));
                        });
                    </script>

                    <div class=" box box-primary " style="padding-left: 10px">

                        @include('order.partialapproval.accountmanagersales')
                        @include('order.partialapproval.salesmanager')
                        @include('order.partialapproval.admin')

                        @if(isset($adminapproval->admin) && trim($adminapproval->admin_approval)=='Approved' && !isset($orderout->order_id))
                            @role((['admin','salesmanager','marketingmanager', 'factoryincharge', 'generalmanager', 'director', 'accountmanagersales']))
                            <h3>Send to warehouse</h3>
                            {!! Form::open(array('route'=>'sendToWarehouse','method'=>'post'))!!}

                            <input name="user_id" value="{{Auth::user()->id}}" hidden>
                            <input name="order_id" value="{{$orderId->id}}" hidden>

                            <div class="form-group clearfix">
                                <label for="warehouse_id"
                                       class="col-sm-4 control-label">Warehouse</label>
                                <div class="col-md-8">
                                    <select id="warehouse" name="warehouse_id" class="form-control"
                                            required>
                                        <option selected="selected" value="" disabled>Choose
                                            Warehouse
                                        </option>

                                        @foreach($ware as $wares)
                                            <option value="{{$wares->id}}">
                                                {{$wares->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div align="right">
                                {{Form::submit('Send', array('class'=>'btn btn-primary'))}}
                            </div>
                            {!! Form::close() !!}
                            @endrole

                        @elseif(isset($orderout->order_id))

                            <div class="panel panel-info ">
                                <div class="panel-heading"><h3>Details of Order Out</h3></div>
                                <h4>Order Send :</h4> {{$orderout->senddate}}
                                <h4>Customer : </h4> {{$orderout->distributor}}
                                <h4>Product Category :</h4>{{$orderout->productname}}
                                <h4>Send By :</h4> {{$orderout->username}}
                                <h4>Send To : </h4> {{$orderout->warehousename}}
                            </div>

                        @endif


                    </div>


                </div>

            </div>

        </div>

    </section>

@endsection


