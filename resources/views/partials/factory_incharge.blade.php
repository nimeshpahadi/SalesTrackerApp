<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Multiple Markers Google Maps</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.11&sensor=false" type="text/javascript"></script>
    <script type="text/javascript">

        var locations = {!! json_encode($locations) !!};

        // check DOM Ready
        $(document).ready(function() {
            // execute
            (function() {
                // map options
                var options = {
                    zoom: 5,
                    center: new google.maps.LatLng(27.6863008, 85.3351921), // centered Nepal
                    mapTypeId: google.maps.MapTypeId.SATTELITE,
                    mapTypeControl: false
                };

                // init map
                var map = new google.maps.Map(document.getElementById('map_canvas'), options);

                // set multiple marker

                $.each( locations, function( i, value ){
                    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(value.latitude , value.longitude),
                        map: map,
                        icon: iconBase + 'parking_lot_maps.png',
                        title: 'Click Me ' + i
                    });

                    var info = "<b>"+value.fullname+"</b>";

                    // process multiple info windows
                    (function(marker, i) {
                        // add click event
                        google.maps.event.addListener(marker, 'click', function() {
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


</head>
<body>

<div id="map_canvas" style="width: 500px; height:300px;"></div>


<div class="col-md-12">
    <div class=" col-md-3">

        <div class="small-box bg-aqua">
            <div class="inner">
                {{--@foreach($ordertoday as $ot)--}}
                    {{--<h3>{{$ot->totalorder}}</h3>--}}
                {{--@endforeach--}}

                <p>Quantity Ordered today</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>

        {{--gauge for total no of salesman active today--}}
        <div class=" col-md-3 col-md-offset-2" id="chart_div">

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['gauge']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        ['Salesman', 15]
                    ]);

                    var options = {
                        width: 450, height: 150,
                        minorTicks:5
                    };

                    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                    chart.draw(data, options);


                }
            </script>

        </div>

    </div>
</div>

<div class="col-md-12" style="padding-top: 20px">
    <div class="col-md-12">
        <div class=" box box-primary">
            <div class="box-body table-responsive ">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Product id</th>
                        <th>Distributor id</th>
                        <th>User id</th>
                        <th>Quantity</th>
                        <th>Priority</th>
                        <th>Payment Term</th>
                        <th>Order date</th>
                        <th>Delivery date</th>
                        <th>Discount</th>
                        <th>Discount</th>
                        <th>Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach($distributor as $dis)--}}
                    {{--<tr>--}}
                    {{--<td>{{$dis->company_name}}</td>--}}
                    {{--<td>{{$dis->contact_name}}</td>--}}
                    {{--<td>Ph:{{$dis->phone}}<br>Mob:{{$dis->mobile}}</td>--}}
                    {{--<td>Zone:{{$dis->zone}}<br>Dis:{{$dis->district}}</td>--}}
                    {{--<td>{{$dis->email}}</td>--}}
                    {{--<td>{{$dis->lead_source}}</td>--}}
                    {{--<td>{{$dis->type}}</td>--}}
                    {{--<td>{{$dis->open_date}}</td>--}}
                    {{--<td>--}}
                    {{--{!! Html::linkRoute('distributor.show','View',array($dis->id),array('class'=>'btn btn-primary btn-block'))!!}--}}


                    {{--</td>--}}

                    {{--</tr>--}}
                    {{--@endforeach--}}

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>