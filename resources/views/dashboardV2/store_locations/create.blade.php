@extends('layouts.dashboard.app')
@section('title','')
@section('description','')
@section('stylesheets')

@endsection
@section('content')

<form action="{{ route('dashboard.storelocations.store') }}" method="post" enctype="multipart/form-data" id="location-form">
    {{ csrf_field() }}
    <div id="autoMap">

    </div>
    <br><br>
    <div class="col-md-6">
        <div class="form-group">
            <input type="hidden" class="form-control" name="latitude" id="lat">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">


            <input type="hidden" class="form-control" name="longitude" id="lng">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('web.dashboard_sub_store_locations_create_address') }}</label>

            <input type="text" class="form-control" name="Searchaddress" id="Searchaddress">
        </div>
    </div>
    <input type="hidden" name="address" id="add">
    <div class="col-md-6">
        <div class="form-group">
            <button class="btn btn-primary">{{ trans('web.dashboard_sub_store_locations_create_save') }}</button>
        </div>
    </div>
</form>

<div class="col-md-6">
    <div class="form-group">
        <button class="btn btn-primary" id="myLocation">{{ trans('web.dashboard_sub_store_locations_create_get_my_location') }}</button>
    </div>
</div>
@endsection
@section('scripts')
<style type="text/css">
#autoMap {
    height: 100%;
    min-height: 500px;
}
</style>
<script>
var markers = [];
function initMap() {
    var myLatlng = {lat: 30.1197986, lng: 31.5370003};
    var map = new google.maps.Map(document.getElementById('autoMap'), {
        zoom: 11,
        center: myLatlng
    });

    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('Searchaddress'));

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        if (typeof place == "undefined") {
            window.alert("Not found!");
        }
        else{
            var place = autocomplete.getPlace();
            var lat = document.getElementById('lat');
            var lng = document.getElementById('lng');
            var add = document.getElementById('add');

            lat.value = place.geometry.location.lat(),
            lng.value = place.geometry.location.lng(),
            add.value = place.formatted_address;

            /////
            map.setZoom(11);
            var marker = new google.maps.Marker({
                position: place.geometry.location,
                map: map
            });
            markers.push(marker);
            infowindow.setContent(place.formatted_address);
            infowindow.open(map, marker);
            map.panTo(marker.getPosition());
            input.value = place.formatted_address;

            console.log(place);
        }
    });
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow;
    google.maps.event.addListener(map, 'click', function( event ){
        var latlng = {lat: event.latLng.lat(), lng: event.latLng.lng()};
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
        geocodeLatLng(geocoder, map, infowindow, latlng);
    });
}

function geocodeLatLng(geocoder, map, infowindow, latlng) {
    var lat = document.getElementById('lat');
    var lng = document.getElementById('lng');
    var add = document.getElementById('add');

    geocoder.geocode({
        location: latlng
    }, function(results, status) {
        if (status === 'OK') {
            console.log(results);
            /* console.log(results[0].geometry.location.lng());
            console.log(results[0].geometry.location.lat());*/
            lat.value = results[0].geometry.location.lat();
            lng.value = results[0].geometry.location.lng();
            add.value = results[0].formatted_address;



            console.log(results[0].formatted_address);
            if (results[0]) {
                map.setZoom(11);
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map
                });
                markers.push(marker);
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
                map.panTo(marker.getPosition());
                input.value = results[0].formatted_address;


            }


        } else {
            window.alert('Geocoder failed due to: ' + status);
        }
    });
}


</script>
<script>
/*
$('#lat').val(geoip_latitude());
$('#lng').val(geoip_longitude());
$('#add').val(geoip_country_name()+ geoip_city());
$('#location-form').submit();*/
$('#myLocation').click(function (){

    var output = document.getElementById("out");

    if (!navigator.geolocation){
        output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
        return;
    }

    function success(position) {
        var latitude  = position.coords.latitude;
        var longitude = position.coords.longitude;




        $('#lat').val(latitude);
        $('#lng').val(longitude);


        var lat = latitude;
        var lng = longitude;
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    // alert("Location: " + results[0].formatted_address);
                    $('#add').val(results[0].formatted_address);
                }
            }
        });

        $('#location-form').submit();

    }

    function error() {
        alert("unable to retrieve your location");
    }



    navigator.geolocation.getCurrentPosition(success, error);

});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ENV('MAPS_API_KEY')}}&callback=initMap&libraries=places"></script>
@endsection
