<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="small-box bg-aqua">
                @foreach($orderQuantitySum as $sum)
                    @if($sum->total_order!=0)
                        <h3>{{$sum->total_order}}</h3>
                    @else
                        <h3>{{ 0 }}</h3>
                    @endif
                @endforeach
                <p style="padding-left:10px "><b>Quantity Ordered Today</b></p>
                    <div class="icon">
                        <i class="ion ion-android-cart"></i>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-maroon">
                @foreach($billing_amount as $bill)
                    @if($bill->billing_amount!=0)
                        <h3>Rs {{number_format($bill->billing_amount, 2)}}</h3>
                    @else
                        <h3>Rs {{ 0 }}</h3>
                    @endif
                @endforeach
                <p><b>Total Billing Amount</b></p>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-green">
                @foreach($paying_amount as $pay)
                    @if($pay->paying_amount!=0)
                        <h3>Rs {{number_format($pay->paying_amount, 2)}}</h3>
                    @else
                        <h3>Rs {{ 0 }}</h3>
                    @endif
                @endforeach
                <p><b>Total Paid Amount</b></p>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
            </div>
        </div>
    </div>


    <div class="nav-tabs-custom col-md-12 ">
        <ul class="nav nav-tabs pull-right">

            <li class="pull-left header"><i class="fa fa-user multiple active"></i> Active SalesMan</li>
        </ul>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBShym8Shyfuu-7t0nll6rzesjl9TOGf_I"></script>
        <script type="text/javascript">

            var locations = {!! json_encode($locations) !!};

            // check DOM Ready
            $(document).ready(function () {
                // execute
                (function () {
                    // map options
                    var options = {
                        zoom: 15,
                        center: new google.maps.LatLng(27.6863008, 85.3351921), // centered Nepal
                        mapTypeId: google.maps.MapTypeId.SATTELITE,
                        mapTypeControl: false
                    };

                    // init map
                    var map = new google.maps.Map(document.getElementById('map_canvas'), options);

                    // set multiple marker
                    $.each(locations, function (i, value) {
                        var iconBase = 'https://maps.google.com/mapfiles/ms/icons/';
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(value.latitude, value.longitude),
                            map: map,
                            icon: iconBase + 'red-dot.png',
                            title: 'Click Me ' + i
                        });

                        var info = "<b>" + value.fullname + "</b>";

                        // process multiple info windows
                        (function (marker, i) {
                            // add click event
                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow = new google.maps.InfoWindow({
                                    content: info
                                });
                                infowindow.open(map, marker);
                            });
                        })(marker, i);
                    });
                })();
            });
        </script>

        <div id="map_canvas" style=" height:400px;"></div>

        <div class="panel panel-info col-md-12">
            <ul>
                @foreach($users as $u)

                    <li>{{$u}}</li>
                @endforeach
            </ul>
        </div>
    </div>




    <div class="col-md-12">
        <div class="col-md-12">
            <div class=" box box-primary">
                <div class="box-body table-responsive ">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Salesman</th>
                            <th>Distributor Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Delivery Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($todayOrders as $o)
                            <tr>
                                <td>{{$o->fullname}}</td>
                                <td>{{$o->contact_name}}</td>
                                <td>{{$o->sub_category}}</td>
                                <td>{{$o->quantity}}</td>
                                <td>{{$o->price}}</td>
                                <td>{{$o->proposed_delivery_date}}</td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>