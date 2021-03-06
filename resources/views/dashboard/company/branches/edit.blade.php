@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/branches/'.$branch->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method('PATCH')


    {{ bs_input("name",$branch->name,true) }}
    {{ bs_input("address",$branch->address,true) }}
    {{ bs_text("description",$branch->description,true) }}

    {{ bs_image("image",$branch->image,false) }}


    <div class="form-group">
        <label class="col-sm-1 control-label" for="openTime" style="text-align:right">
            {{ __("dashboard.openTime") }}
        </label>
        <div class="col-sm-6">
            <input type="time" name="openTime" placeholder='{{ __("dashboard.openTime") }}' id="openTime"
                class="form-control" required value="{{ old("openTime") ?? $branch->open_time }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-1 control-label" for="closeTime" style="text-align:right">
            {{ __("dashboard.closeTime") }}
        </label>
        <div class="col-sm-6">
            <input type="time" name="closeTime" placeholder='{{ __("dashboard.closeTime") }}' id="closeTime"
                class="form-control" required value="{{ old("closeTime") ?? $branch->close_time }}">
        </div>
    </div>



    {{ bs_input("minutes_before_closing",$branch->minutes_before_closing,true) }}





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
            <input type="text" id="lng" name="lng" value="{{ $branch->lng }}"
                placeholder='{{ __("dashboard.clickMap") }}' class="form-control" readonly>
        </div>

        <div class="col-sm-3">
            <input type="text" id="lat" name="lat" value="{{ $branch->lat }}"
                placeholder='{{ __("dashboard.clickMap") }}' class="form-control" readonly>
        </div>
    </div>

    <div class="page-header">
        <h1>{{ __("dashboard.userInfo") }}</h1>
    </div>

    {{ bs_input("username",$branch->user->name,true) }}
    {{ bs_email("email",$branch->user->email,true) }}
    {{ bs_input("phone",$branch->user->phone,true) }}
    {{ bs_password("password",null,false,true) }}
    {{ bs_password("password_confirmation",null,false) }}

    {{ bs_save("save") }}


</form>
@endsection

@section('assets')
<script>
    var lng = $("#lng").val();
    var lat = $("#lat").val();
    var markers = [];
    var loc = [lng, lat];


    var map = new mapboxgl.Map({
        container: 'add_branch_map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: loc,
        zoom: 14
    });

    map.on("load", function () {
        map.setLayoutProperty('country-label-lg', 'text-field', ['get', 'name_en']);

        var gecoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            country: "SY",
            language: "ar",
            bbox: [35.641849, 32.757361, 36.941157, 37.395157],
            placeholder: "اسم المحافظة"
        });

        map.addControl(gecoder);


        var marker = new mapboxgl.Marker({
            color: "rgb(187, 179, 236)"
        }).setLngLat([lng, lat]).addTo(map);

        markers.push(marker);

        map.on("click", function (e) {
            markers.forEach(element => {
                element.remove();
            });

            var lng = e.lngLat.lng;
            var lat = e.lngLat.lat;
            $("#lng").val(lng);
            $("#lat").val(lat);

            var marker = new mapboxgl.Marker({
                color: "rgb(187, 179, 236)"
            }).setLngLat([lng, lat]).addTo(map);

            markers.push(marker);
        });
    });

</script>


@endsection
