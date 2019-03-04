

@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('dashboard/branches') }}" class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}
    {{ bs_input("address",null,true) }}
    {{ bs_text("description",null,true) }}

    <input hidden name="lng" value="1.5">
    <input hidden name="lat" value="1.5">



    <div class="page-header">
        <h1>{{ __("dashboard.ownerInfo") }}</h1>
    </div>

    {{ bs_input("username",null,true) }}
    {{ bs_email("email",null,true) }}
    {{ bs_input("phone",null,true) }}
    {{ bs_password("password",null,true) }}
    {{ bs_password("password_confirmation",null,true) }}
    {{ bs_save("save") }}

</form>
@endsection

@section('assets')
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<div id='map'></div>
<script>
mapboxgl.accessToken = 'pk.eyJ1Ijoid2FzZWVtYWxoYWJhc2giLCJhIjoiY2pzcWo3MmgyMTRlNTQ0bzQ1MWMyOGtzZSJ9.Hk7_kl2Oh9TH-i8513BV1g';
var map = new mapboxgl.Map({
container: 'map', // container id
style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
center: [-74.50, 40], // starting position [lng, lat]
zoom: 9 // starting zoom
});
</script>

    
@endsection
