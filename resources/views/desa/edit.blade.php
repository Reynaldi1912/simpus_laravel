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
            <form action="{{route('desa.update' , $key->id)}}" method="post" class="block">
                @csrf
                @method('PUT')
                <div class="p-3 block-header-default">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="block-title">Form Edit Desa</h3>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-12 pb-3">
                            <label for="">Nama Desa</label>
                            <input type="text" name="txtNamaDesa" class="form-control" value="{{$key->nama_desa}}" required>
                        </div>
                        <div class="col-4">
                            <label for="">Latitude</label>
                            <input type="text" name="txtLatitude" class="form-control" id="lat" value="{{$key->latitude}}" readonly required>
                        </div>
                        <div class="col-4">
                            <label for="">Longitude</label>
                            <input type="text" name="txtLongitude" class="form-control" id="lon" value="{{$key->longitude}}" readonly required>
                        </div>
                        <div class="col-4">
                            <label for="">Radius Petugas(KM)</label>
                            <input type="number" class="form-control" name="txtRadius" id="txtRadius" value="{{$key->radius}}" onchange="getRadius();" required required value="2">
                        </div>
                    </div>     
                    <div id="map"></div>               
                </div>
            </form>
        </div>
    </div>
</div>

<script>
        var _radius = document.querySelector('#txtRadius').value;
        var _lat = document.querySelector('#lat').value;
        var _lon = document.querySelector('#lon').value;

        var map = L.map('map').setView([_lat,_lon], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([ _lat , _lon]).addTo(map)
        .openPopup();

        var circle = new L.circleMarker();
        circle = L.circle([_lat, _lon], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.2,
            radius: _radius*1000
        }).addTo(map);
  
    
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