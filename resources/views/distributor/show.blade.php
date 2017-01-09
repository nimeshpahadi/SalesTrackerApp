@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <h1 align="center"> {{$dist->company_name}}</h1>

                    <!-- /.box-header -->

                    <div class="container-fluid ">

                        <div class="col-md-12 ">

                            <div class="row">
                                <h3> Details</h3>
                                @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                                <div align="right">
                                    <div class="col-md-11 col-sm-10">
                                        <a href="{!! route('distributor.edit',$dist->id)!!}">
                                            <span class="  btn btn-primary glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </div>
                                    @role((['admin','salesmanager','accountmanagersales','director','generalmanager']))
                                    {!! Form::open(['method' => 'DELETE','route' => ['distributor.destroy', $dist->id]]) !!}
                                    <button type="submit" class="btn btn-danger glyphicon glyphicon-trash"
                                            onclick="return confirm('Are you sure you want to delete this item?');">

                                    </button>

                                    {!! Form::close() !!}
                                    @endrole
                                </div>
                                @endrole
                                <hr>
                                <div class="col-md-6">


                                    <div class="row">
                                        <label class="col-sm-6 ">Contact Name :</label>
                                        {{$dist->contact_name}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">Email :</label>
                                        {{$dist->email}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">Phone No.:</label>
                                        {{$dist->phone}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">Mobile:</label>
                                        {{$dist->mobile}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">Zone :</label>
                                        {{$dist->zone}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">District :</label>
                                        {{$dist->district}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">Lead Source :</label>
                                        {{$dist->lead_source}}
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 ">Type :</label>
                                        {{$dist->type}}
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-6 ">Open Date :</label>
                                        {{$dist->open_date}}
                                    </div>

                                    <h3> Amount</h3>
                                    <hr>

                                    <div class="row">
                                        <label class="col-sm-6 ">Billing Amount :</label>
                                        {{$billing_transaction->billing_amount}}
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-6 ">Paid Amount :</label>
                                        {{$paying_transaction->paid_amount}}
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-6 ">Total Due :</label>
                                        <?php  $due = $paying_transaction->paid_amount -
                                                $billing_transaction->billing_amount ?>
                                        @if($due<0)
                                            {{ -$due }}
                                        @else
                                            {{ $due }} (Advance)
                                        @endif
                                    </div>

                                    @if(!isset($guarantee))

                                        @role((['admin','salesmanager','accountmanagersales','director','generalmanager']))
                                        <div align="right">

                                            <a href="{{route('distributor_guarantee',$dist->id)}}">
                                                <span class=" btn btn-success glyphicon glyphicon-plus">Guarantee</span>
                                            </a>
                                        </div>
                                        @endrole
                                    @else



                                        <h3> Guarantee</h3>
                                        <hr>
                                        <a href="{!! route('guarantee_edit',$dist->id)!!}">
                                            <span class="  btn btn-primary ">Edit</span>
                                        </a>
                                        <div class="row">
                                            <label class="col-sm-6 ">Type :</label>
                                            {{($guarantee->type)}}
                                        </div>
                                        @if(isset($guarantee->bank_name))
                                            <div class="row">
                                                <label class="col-sm-6 ">Bank name :</label>
                                                {{($guarantee->bank_name)}}
                                            </div>
                                        @endif
                                        @if(isset($guarantee->cheque_no))
                                            <div class="row">
                                                <label class="col-sm-6 ">Cheque no :</label>
{{--                                                {{($guarantee->cheque_no)}}--}}
                                            </div>
                                        @endif
                                        @if(isset($guarantee->remark))
                                            <div class="row">
                                                <label class="col-sm-6 ">Remarks :</label>
                                                {{($guarantee->remark)}}
                                            </div>
                                        @endif

                                        <div class="row">
                                            <label class="col-sm-6 ">Amount :</label>
                                            {{strtoupper($guarantee->amount)}}
                                        </div>
@endif


                                </div>


                                <div class="col-md-6">


                                    <div id="map" style="width:450px;height:320px;"></div>
                                    <script>
                                        function initMap() {
                                            var myLatLng = {
                                                lat: <?php echo "$dist->latitude"?>,
                                                lng:<?php echo "$dist->longitude"?>};

                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 17,
                                                center: myLatLng
                                            });

                                            var marker = new google.maps.Marker({
                                                position: myLatLng,
                                                map: map,
                                                title: 'company'
                                            });
                                        }
                                    </script>
                                    <script async defer
                                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9Zpoo5Nys5kmX5LpMbzYGI98SoX72wf0&callback=initMap">
                                    </script>


                                </div>
                            </div>
                        </div>


                    </div>


                </div>


            </div>


            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Addresses</h3>
                        <div align="right">

                            @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                            @if(empty($address["Billing"]))
                                <a class=" btn btn-success"
                                   href="{{route('distributor_address',["id"=>$dist->id,"type"=>1])}}">Add
                                    Billing address</a>
                            @endif
                            @if(empty($address["Shipping"]))
                                <a class=" btn btn-success"
                                   href="{{route('distributor_address',["id"=>$dist->id,"type"=>2])}}">Add
                                    shipping address</a>
                            @endif
                            @if(empty($address["Billing"]) && empty($address["Shipping"]))
                                <a class=" btn btn-success"
                                   href="{{route('distributor_address',["id"=>$dist->id,"type"=>3])}}">Add
                                    Both
                                    address</a>
                            @endif
                            @endrole

                        </div>
                        <div class="row clearfix">

                            <div class="col-md-12 clearfix">

                                @if(!empty($address["Billing"]))
                                    @include('distributor.Partials.address',["add"=>$address["Billing"]])
                                @endif
                                @if(!empty($address["Shipping"]))
                                    @include('distributor.Partials.address',["add"=>$address["Shipping"]])
                                @endif

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 clearfix ">
                    <div class="tabbable box box-primary " id="tabs-512934">
                        <ul class="nav nav-tabs nav-justified ">
                            <li class="active">
                                <a class="btn btn-primary" href="#order" data-toggle="tab">ORDER</a>
                            </li>
                            <li>
                                <a class="btn btn-primary" href="#payment" data-toggle="tab">Payment</a>
                            </li>


                            <li>
                                <a class="btn btn-google" href="#visit" data-toggle="tab">VISIT</a>
                            </li>

                            <li>
                                <a class="btn btn-success" href="#min" data-toggle="tab">MINUTE</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="order">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Price/sack</th>
                                        <th>Quantity</th>
                                        <th>Priority</th>
                                        <th>Payment term</th>
                                        <th>Delivery date</th>

                                        <th>Username</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order as $orders)


                                        <tr>

                                            <td>{{$orders->created_at}}</td>
                                            <td>{{$orders->subCategory}}</td>
                                            <td>{{$orders->price}}</td>
                                            <td>{{$orders->quantity}}</td>
                                            <td>{{$orders->priority}}</td>
                                            <td>{{$orders->payment_term}}</td>
                                            <td>{{$orders->proposed_delivery_date}}</td>
                                            <td>{{$orders->userName}}</td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane " id="min">
                                @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                                <div align="right">
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#price{{$dist->id}}">Add Minute
                                    </button>
                                </div>
                                @endrole
                                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                     id="price{{$dist->id}}" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm ">
                                        <div class="modal-content " style="padding: 10px">

                                            {!! Form::open(array('route' => 'minute_store'))!!}
                                            <h3>Add Minute</h3>
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="report"
                                                       style="padding: 30px" required>

                                                {{--</input>--}}
                                                <input name="user_id" hidden value='{{ Auth::user()->id }}'>
                                                <input name="distributor_id" hidden value='{{$dist->id}}'>


                                            </div>
                                            <div align="right" style="padding: 10px">
                                                {{Form::submit('Save ', array('class'=>'btn btn-primary'))}}
                                                <a type="button" class="btn btn-warning"
                                                   href="/distributor/{{$dist->id}}">Cancel</a>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Created at</th>
                                        <th>User name</th>
                                        <th>Minute</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($minute as $min)

                                        <tr>
                                            <td>{{$min->created_at}}</td>
                                            <td>{{$min->user_fullname}}</td>
                                            <td>{{$min->minute_report}}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                   href="{{route("minute_location",["id"=>$min->distributor_id,
                                                                 "lat"=>$min->latitude,
                                                                 "long"=>$min->longitude,
                                                                 "user"=>$min->user_fullname])}}">Location</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="tab-pane " id="payment">
                                <div align="right">
                                    <a href="{{route('create_payment',$dist->id)}}">
                                        <span class=" btn btn-success glyphicon glyphicon-plus"> payment</span>
                                    </a>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>

                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Username</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payment as $pay)
                                        <tr>

                                            <td>{{$pay->created_at}}</td>
                                            <td>{{$pay->amount}}</td>
                                            <td>{{$pay->type}}</td>
                                            <td>{{$pay->userName}}</td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="visit">
                                <div class="panel-body">
                                    @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                                    <div align="right">
                                        <a class=" btn btn-success"
                                           href="{{route('distributor_tracking',$dist->id)}}">Add
                                            Visit</a>
                                    </div>
                                    @endrole
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Created at</th>
                                            <th>Stage</th>
                                            <th>Business Probability</th>
                                            <th>Activity</th>
                                            <th>Loss Reason</th>
                                            <th>Is Our Customer</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tracking as $t)
                                            <tr>
                                                <td>{{$t->created_at}}</td>
                                                <td>{{$t->stage}}</td>
                                                <td>{{$t->business_probability}}%</td>
                                                <td>{{$t->activity}}</td>
                                                <td>{{$t->loss_reason}}</td>
                                                <td>{{$t->is_our_customer}}</td>
                                                <td>
                                                    <a class="btn btn-primary"
                                                       href="{{route("visit_location",["id"=>$t->distributor_id,
                                                                 "lat"=>$t->latitude,
                                                                 "long"=>$t->longitude,
                                                                 "user"=>$t->user_fullname])}}">Location</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection