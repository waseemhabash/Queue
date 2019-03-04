@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("dashboard/companies/$company_id/branches") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}
    {{ bs_input("address",null,true) }}
    {{ bs_text("description",null,true) }}


    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.location") }}
        </label>
        <div class="col-sm-6">
            <div id="add_branch_map" style="width:100%;height:400px">

            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
        </label>
        <div class="col-sm-3">
            <input type="text" id="lng" name="lng" placeholder='{{ __("dashboard.clickMap") }}' class="form-control" readonly>
        </div>

        <div class="col-sm-3">
            <input type="text" id="lat" name="lat" placeholder='{{ __("dashboard.clickMap") }}' class="form-control" readonly>
        </div>
    </div>


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
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
<script>
    var lng = 36.29636509318212;
    var lat = 33.51517910706413;
    var markers = [];
    var loc = [lng, lat];

    mapboxgl.accessToken =
        'pk.eyJ1Ijoid2FzZWVtYWxoYWJhc2giLCJhIjoiY2pzcWo3MmgyMTRlNTQ0bzQ1MWMyOGtzZSJ9.Hk7_kl2Oh9TH-i8513BV1g';
    mapboxgl.setRTLTextPlugin(
        'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.0/mapbox-gl-rtl-text.js');

    var map = new mapboxgl.Map({
        container: 'add_branch_map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: loc,
        zoom: 14
    });

    map.on("load", function () {
        map.setLayoutProperty('country-label-lg', 'text-field', ['get', 'name_en']);

        map.on("click", function (e) {
            markers.forEach(element => {
                element.remove();
            });

            var lng = e.lngLat.lng;
            var lat = e.lngLat.lat;
            $("#lng").val(lng);
            $("#lat").val(lat);

            var marker = new mapboxgl.Marker({
                color: "rgb(0, 101, 92)"
            }).setLngLat([lng, lat]).addTo(map);

            markers.push(marker);
        });
    });

</script>


@endsection
