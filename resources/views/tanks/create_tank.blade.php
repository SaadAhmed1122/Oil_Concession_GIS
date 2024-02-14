@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Tank</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tanks.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="concession_code">Concession:</label>
                                <select class="form-control" id="concession_code" name="concession_code">
                                    <option value="">Select Concession</option>
                                    @foreach ($concessions as $concession)
                                        <option value="{{ $concession->concession_id }}">{{ $concession->concession_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="well_code">Well:</label>
                                <select class="form-control" id="well_code" name="well_code">
                                    <option value="">Select Well</option>
                                    @foreach ($wells as $well)
                                        <option value="{{ $well->well_code }}">{{ $well->well_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="capacity">Capacity:</label>
                                <input type="decimal" class="form-control" id="capacity" name="capacity">
                            </div>Kg

                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" name="latitude">
                            </div>

                            <div class="form-group">
                                <label for="longitude">Longitude:</label>
                                <input type="text" class="form-control" id="longitude" name="longitude">
                            </div>

                            <div class="form-group">
                                <label for="polyline">Polyline:</label>
                                <input type="text" class="form-control" id="polyline" name="polyline">
                            </div>

                            <div id="map" style="width: 100%; height: 400px;"></div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13); // Set initial view
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([51.505, -0.09]).addTo(map); // Initialize marker, you can update initial position if needed

        map.on('click', function(e) {
            var latlng = e.latlng;
            marker
                .setLatLng(e.latlng)
                .addTo(map);
            document.getElementById('latitude').value = latlng.lat.toFixed(6);
            document.getElementById('longitude').value = latlng.lng.toFixed(6);
        });

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        var drawControl = new L.Control.Draw({
            draw: {
                polyline: true,
                polygon: false,
                rectangle: false,
                circle: false,
                marker: false
            },
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);
        map.on(L.Draw.Event.CREATED, function(event) {
            var layer = event.layer;
            var polyline = layer.toGeoJSON();
            var latLngs = polyline.geometry.coordinates.map(function(coords) {
                return coords.reverse();
            });
            document.getElementById('polyline').value = JSON.stringify(latLngs);
            drawnItems.addLayer(layer);
        });


        var greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var wells = {!! json_encode($wells->toArray()) !!};

        wells.forEach(function(well) {
            L.marker([well.latitude, well.longitude], {
                icon: greenIcon
            }).addTo(map);
        });
    </script>
@endsection
