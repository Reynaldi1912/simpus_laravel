@extends('layouts.app')

@section('content')
<style>
    #map { 
        height: 500px; 
        margin-top: 20px;
    }
</style>
<div class="container m-3">
    <div class="main-container">
        <div class="content">
            <form action="{{route('desa.store')}}" method="post" class="block">
                @csrf
                <div class="p-3 block-header-default">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="block-title">Form Tambah Desa</h3>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-success show_confirm_simpan" data-toggle="tooltip">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-12 pb-3">
                            <label for="">Nama Desa</label>
                            <input type="text" name="txtNamaDesa" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <label for="">Latitude</label>
                            <input type="text" name="txtLatitude" class="form-control" id="lat" readonly required>
                        </div>
                        <div class="col-4">
                            <label for="">Longitude</label>
                            <input type="text" name="txtLongitude" class="form-control" id="lon" readonly required>
                        </div>
                        <div class="col-4">
                            <label for="">Radius Petugas(KM)</label>
                            <input type="number" class="form-control" name="txtRadius" id="txtRadius" onchange="getRadius();" required required value="2">
                        </div>
                    </div>     
                    <div id="map"></div>               
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var map = L.map('map').setView([ -8.057241,113.231867], 13);
    var circle = new L.circleMarker();
    var _radius = document.querySelector('#txtRadius').value;
    var _lat = 0;
    var _lon = 0;


    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([ -8.057241,113.231867]).addTo(map)
        .openPopup();
    
    function getRadius(){
        _radius = document.querySelector('#txtRadius').value;

        map.removeLayer(circle);

        circle = L.circle([_lat, _lon], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.2,
            radius: _radius*1000
        }).addTo(map);
    }

    map.on("click", function(e) {
        var latlng = e.latlng;
        _lat = latlng.lat;
        _lon = latlng.lng;
        document.getElementById("lat").value = latlng.lat;
        document.getElementById("lon").value = latlng.lng;

        marker.setLatLng(latlng);
        map.removeLayer(circle);

        circle = L.circle([_lat, _lon], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.2,
            radius: _radius*1000
        }).addTo(map);
    });
</script>
@endsection