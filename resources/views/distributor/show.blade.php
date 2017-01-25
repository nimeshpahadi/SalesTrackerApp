@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-success">
                    <h1 align="center"> {{$dist->company_name}}</h1>

                    <div class="container-fluid ">

                        <div class="col-md-12 ">

                            <div class="row">

                                @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                                <div align="right">
                                    <div>
                                        <a href="{!! route('distributor.edit',$dist->id)!!}">
                                            <span class="  btn btn-primary glyphicon glyphicon-pencil"   data-toggle="popover" data-trigger="hover"
                                                  data-placement="top"   data-content="Edit the customer details of {{$dist->company_name}}"></span>
                                        </a>
                                    </div>
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
                                        Rs. {{number_format($billing_transaction->billing_amount)}}
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-6 ">Paid Amount :</label>
                                        Rs. {{number_format($paying_transaction->paid_amount)}}
                                    </div>

                                    <div class="row">
                                        <?php  $due = $paying_transaction->paid_amount -
                                                $billing_transaction->billing_amount ?>
                                        <label class="col-sm-6 ">Total  @if($due<0)
                                                Due :
                                            @else
                                        Advance :
                                            @endif</label>

                                        @if($due<0)
                                            Rs. {{number_format(-$due)}}
                                        @else
                                            Rs. {{number_format($due)}}
                                        @endif
                                    </div>

                                    @if(!isset($guarantee))

                                        @role((['admin','salesmanager','accountmanagersales','director','generalmanager']))
                                        <div align="right" class="pad">

                                            <a href="{{route('distributor_guarantee',$dist->id)}}">
                                                <span class=" btn btn-success glyphicon glyphicon-plus" title="Add Guarantee for customer {{$dist->company_name}}">Guarantee</span>
                                            </a>
                                        </div>
                                        @endrole
                                    @else


                                        <h3> Guarantee</h3>
                                        <hr>
                                        <a href="{!! route('guarantee_edit',$dist->id)!!}">
                                            <span class="  btn btn-primary glyphicon glyphicon-edit " title="Edit Guarantee for customer {{$dist->company_name}}"></span>
                                        </a>
                                        <div class="row">
                                            <label class="col-sm-6 ">Type :</label>
                                            {{($guarantee->type)}}
                                        </div>
                                        @if(($guarantee->bank_name)!=null)
                                            <div class="row">
                                                <label class="col-sm-6 ">Bank Name :</label>
                                                {{($guarantee->bank_name)}}
                                            </div>
                                        @endif
                                        @if(($guarantee->cheque_no)!=null)
                                            <div class="row">
                                                <label class="col-sm-6 ">Cheque No :</label>
                                                {{($guarantee->cheque_no)}}
                                            </div>
                                        @endif

                                        @if(($guarantee->amount)!=null)
                                            <div class="row">
                                                <label class="col-sm-6 ">Amount :</label>
                                                Rs. {{number_format($guarantee->amount)}}
                                            </div>
                                        @endif

                                        @if(isset($guarantee->remark))
                                            <div class="row">
                                                <label class="col-sm-6 ">Remarks :</label>
                                                {{($guarantee->remark)}}
                                            </div>
                                        @endif
                                    @endif


                                </div>


                                {{--<div class="col-md-6">--}}


                                    <div id="map" class="col-md-6 map"></div>
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
                        {{--</div>--}}


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
                                <a class=" btn btn-success" title="Add Billing Address for customer {{$dist->company_name}}"
                                   href="{{route('distributor_address',["id"=>$dist->id,"type"=>1])}}">Add
                                    Billing Address</a>
                            @endif
                            @if(empty($address["Shipping"]))
                                <a class=" btn btn-success" title="Add Shipping Address for customer {{$dist->company_name}}"
                                   href="{{route('distributor_address',["id"=>$dist->id,"type"=>2])}}">Add
                                    Shipping Address</a>
                            @endif
                            @if(empty($address["Billing"]) && empty($address["Shipping"]))
                                <a class=" btn btn-success" title="Add Billing & Shipping Address for customer {{$dist->company_name}}"
                                   href="{{route('distributor_address',["id"=>$dist->id,"type"=>3])}}">Add
                                    Both Address</a>
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

                            @if($dist->status==1 )
                                <li class="active">
                                    <a class="btn btn-primary"  title="Click here to view {{$dist->company_name}}'s Order Summary" href="#order" data-toggle="tab">Order</a>

                                </li>
                                <li>
                                    <a class="btn btn-primary" title="Click here to view {{$dist->company_name}}'s Payment Summary" href="#payment" data-toggle="tab">Payment</a>
                                </li>
                            @endif

                            @if($dist->status==0 )
                                <li>
                                    <a class="btn btn-google" title="Click here to view {{$dist->company_name}}'s Visit Summary" href="#visit" data-toggle="tab">Visit</a>
                                </li>
                            @endif

                            @if($dist->status==0 || $dist->status==1)
                                <li >
                                    <a class="btn btn-success" title="Click here to view {{$dist->company_name}}'s Minute Summary" href="#min" data-toggle="tab">Minute</a>
                                </li>
                            @endif

                        </ul>
                        <div class="tab-content">
                            @if($dist->status==1 )
                            <div class="tab-pane active" id="order">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Price/Sack</th>
                                        <th>Quantity</th>
                                        <th>Priority</th>
                                        <th>Delivery Date</th>
                                        <th>Created By</th>
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
                                            <td>{{$orders->proposed_delivery_date}}</td>
                                            <td>{{$orders->userName}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                                @if($dist->status==0 || $dist->status==1)
                            <div class="tab-pane pad " id="min">
                                @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                                <div align="right">
                                    <button class="btn btn-sm btn-primary  " data-toggle="modal" title="Add minute for customer {{$dist->company_name}}"
                                            data-target="#price{{$dist->id}}">Add Minute
                                    </button>
                                </div>
                                @endrole
                                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                     id="price{{$dist->id}}" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md ">
                                        <div class="modal-content pad" >

                                            {!! Form::open(array('route' => 'minute_store'))!!}
                                            <h3>Add Minute</h3>
                                            <div class="form-group col-md-12">
                                                <textarea type="text" class="form-control" name="report"
                                                          height="100px" required></textarea>


                                                <input name="user_id" hidden value='{{ Auth::user()->id }}'>
                                                <input name="distributor_id" hidden value='{{$dist->id}}'>


                                            </div>
                                            <div align="right" class="pad">
                                                {{Form::submit('Save ', array('class'=>'btn btn-primary','title'=>"Save minute for customer {$dist->company_name}"))}}
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
                                        <th>Created At</th>
                                        <th>Created By</th>
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
                                                <a class="btn btn-primary"  title="Click here to view {{$min->user_fullname}}'s location"
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
                                @endif
                                @if($dist->status==1 )
                            <div class="tab-pane pad " id="payment">

                                @role((['admin','salesmanager','accountmanagersales','director','generalmanager']))
                                <div align="right">
                                    <a href="{{route('create_payment',$dist->id)}}" >
                                        <span class=" btn btn-sm btn-success pad " title="Create the payment for customer {{$dist->company_name}}" >payment</span>
                                    </a>
                                </div>
                                @endrole
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Bank Name</th>
                                        <th>Cheque No.</th>
                                        <th>Cheque Date.</th>
                                        <th>Created By</th>
                                        <th>Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payment as $pay)
                                        <tr>

                                            <td>{{$pay->created_at}}</td>
                                            <td>{{$pay->amount}}</td>
                                            <td>{{$pay->type}}</td>
                                            <td>{{$pay->bank_name}}</td>
                                            <td>{{$pay->cheque_no}}</td>
                                            <td> @if($pay->cheque_date!="0000-00-00")
                                            {{$pay->cheque_date}}
                                            @endif
                                            </td>
                                            <td>{{$pay->userName}}</td>
                                            <td>{{$pay->remark}}</td>



                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                                @endif
                                @if($dist->status==0 )
                            <div class="tab-pane" id="visit">
                                <div class="panel-body">
                                    @role((['admin','salesmanager','accountmanagersales','director','generalmanager','salesman']))
                                    <div align="right">
                                        <a class=" btn btn-primary btn-sm" title="Add visit for customer {{$dist->company_name}}"
                                           href="{{route('distributor_tracking',$dist->id)}}">Add
                                            Visit</a>
                                    </div>
                                    @endrole
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Stage</th>
                                            <th>Business Probability</th>
                                            <th>Activity</th>
                                            <th>Loss Reason</th>
                                            <th>Remark</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tracking as $t)
                                            <tr>
                                                <td>{{$t->user_fullname}}</td>
                                                <td>{{$t->created_at}}</td>
                                                <td>{{$t->stage}}</td>
                                                <td>{{$t->business_probability}}%</td>
                                                <td>{{$t->activity}}</td>
                                                <td>{{$t->loss_reason}}</td>
                                                <td>
                                                   @if($t->remark!=null)
                                                        <button class="btn btn-primary glyphicon glyphicon-info-sign"
                                                            data-toggle="popover" data-trigger="hover"
                                                            data-content="{{$t->remark}}">
                                                    </button>
                                                       @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" title="Click here to view {{$t->user_fullname}}'s location"
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
                                @endif
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