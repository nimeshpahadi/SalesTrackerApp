@extends('Layout.app')

@section('main-content')


    <div class="col-md-12 map">
        <div class="box-header"><b>User Location</b></div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBShym8Shyfuu-7t0nll6rzesjl9TOGf_I"></script>
        <script type="text/javascript">

            var locations = {!! json_encode($visitData) !!};
            console.log(locations.user);
            $(document).ready(function () {
                (function () {
                    var options = {
                        zoom: 15,
                        center: new google.maps.LatLng(27.6863008, 85.3351921), // centered Nepal
                        mapTypeId: google.maps.MapTypeId.SATTELITE,
                        mapTypeControl: false
                    };
                    var map = new google.maps.Map(document.getElementById('map_canvas'), options);

                    var iconBase = 'https://maps.google.com/mapfiles/ms/icons/';
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations.lat, locations.long),
                        map: map,
                        icon: iconBase + 'red-dot.png'
                    });


                    infowindow = new google.maps.InfoWindow({
                        content: locations.user
                    });
                    infowindow.open(map, marker);

                })();
            });
        </script>

        <div id="map_canvas" style="height:670px;"></div>
    </div>

@endsection