@extends('layouts.app')
@section('content')

<head>
    <meta charset="utf-8" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <script src="https://kit.fontawesome.com/ab2155e76b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <!-- Google Map Css -->
    {{ Html::style(url('mdh/plugins/map/App.css')) }}
    {{ Html::style(url('mdh/plugins/map/Content/bootstrap.min.css')) }}

</head>

<body>
    <div class="jumbotron">
        <div class="container-fluid">
            <h1>Find The Distance Between Two Places.</h1>

            <form class="form-horizontal">
                <div class="form-group">
                    <label for="from" class="col-xs-2 control-label"><i class="far fa-dot-circle"></i></label>
                    <div class="col-xs-4">
                        <input type="text" id="from" placeholder="Origin" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="to" class="col-xs-2 control-label"><i class="fas fa-map-marker-alt"></i></label>
                    <div class="col-xs-4">
                        <input type="text" id="to" placeholder="Destination" class="form-control" />
                    </div>
                </div>
            </form>

            <div class="col-xs-offset-2 col-xs-10">
                <button class="btn btn-info btn-lg" onclick="calcRoute();">
                    <i class="fa fa-location-arrow"></i>
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="googleMap"></div>
            <div id="output"></div>
        </div>
    </div>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1QQqFo-up3KsoKw8AEko98izYqsSxaDQ&libraries=places"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Scripts/jquery-3.1.1.min.js"></script>

</body>

@endsection
<!-- @push("after-scripts")
<script>
    //javascript.js
    //set map options
    var myLatLng = {
        lat: -6.78637,
        lng: 39.2789
    };
    var mapOptions = {
        center: myLatLng,
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    //create map
    var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

    //create a DirectionsService object to use the route method and get a result for our request
    var directionsService = new google.maps.DirectionsService();

    //create a DirectionsRenderer object which we will use to display the route
    var directionsDisplay = new google.maps.DirectionsRenderer();

    //bind the DirectionsRenderer to the map
    directionsDisplay.setMap(map);

    //define calcRoute function
    function calcRoute() {
        //create request
        var request = {
            origin: document.getElementById("from").value,
            destination: document.getElementById("to").value,
            travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
            unitSystem: google.maps.UnitSystem.KILOMETER
        };

        var request2 = {
            origin: document.getElementById("from").value,
            destination: document.getElementById("to").value,
            travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
            unitSystem: google.maps.UnitSystem.KILOMETER
        };

        //pass the request to the route method
        directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                //Get distance and time
                const output = document.querySelector("#output");
                output.innerHTML =
                    "<div class='alert-info'>From: " +
                    document.getElementById("from").value +
                    ".<br />To: " +
                    document.getElementById("to").value +
                    ".<br /> Driving distance <i class='fas fa-road'></i> : " +
                    result.routes[0].legs[0].distance.text +
                    ".<br />Duration <i class='fas fa-hourglass-start'></i> : " +
                    result.routes[0].legs[0].duration.text +
                    ".</div>";
                request2.driving_distance = result.routes[0].legs[0].distance.text;
                request2.duration = result.routes[0].legs[0].duration.text;
                request2._token = "{{ csrf_token()}}";
                $.ajax({
                    url: "{{route('distance')}}",
                    type: "post",
                    data: request2,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
                console.log(request2);
                directionsDisplay.setDirections(result);
            } else {
                //delete route from map
                directionsDisplay.setDirections({
                    routes: []
                });
                //center map in London
                map.setCenter(myLatLng);

                //show error message
                output.innerHTML =
                    "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Could not retrieve driving distance.</div>";
            }
        });
    }

    //create autocomplete objects for all inputs
    var options = {
        types: ["(cities)"]
    };

    var input1 = document.getElementById("from");
    var autocomplete1 = new google.maps.places.Autocomplete(input1, options);

    var input2 = document.getElementById("to");
    var autocomplete2 = new google.maps.places.Autocomplete(input2, options);
</script>
@endpush -->