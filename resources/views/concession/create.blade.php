@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Concession</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('concessions.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="concession_name">Concession Name</label>
                                <input type="text" name="concession_name" id="concession_name" class="form-control"
                                    required>
                            </div>

                            <!-- Map Container -->
                            <div id="map" style="height: 400px;"></div>

                            <!-- Hidden Input for Geometry -->
                            <div class="form-group">
                                <input id="geometry" type="text" class="form-control" name="geometry">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Concession</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Wait for the DOM content to be fully loaded before executing the script
        // document.addEventListener('DOMContentLoaded', function() {
        // Initialize Leaflet map
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        //     // Initialize drawnItems FeatureGroup
        //     var drawnItems = new L.FeatureGroup();
        //     map.addLayer(drawnItems);

        //     // Initialize drawControl and add to map
        //     var drawControl = new L.Control.Draw({
        //     position: 'topright',
        //     draw: {
        //         polygon: {
        //             shapeOptions: {
        //                 color: 'purple' //polygons being drawn will be purple color
        //             },
        //             allowIntersection: false,
        //             drawError: {
        //                 color: 'orange',
        //                 timeout: 1000
        //             },
        //             showArea: true, //the area of the polygon will be displayed as it is drawn.
        //             metric: false,
        //             repeatMode: true
        //         },
        //         polyline: {
        //             shapeOptions: {
        //                 color: 'red'
        //             },
        //         },
        //         circlemarker: false, //circlemarker type has been disabled.
        //         rect: {
        //             shapeOptions: {
        //                 color: 'green'
        //             },
        //         },
        //         circle: false,
        //     },
        //     edit: {
        //         featureGroup: drawnItems
        //     }
        // });
        // map.addControl(drawControl);

        //     // Event listener for draw:created
        //     map.on('draw:created', function(e) {
        //         var layer = e.layer;
        //         console.log(layer);
        //         drawnItems.clearLayers();
        //         drawnItems.addLayer(layer);
        //         var geoJSON = layer.toGeoJSON();
        //         console.log(geoJSON);

        //         document.getElementById('geometry').value = JSON.stringify(geoJSON.geometry);
        //     });
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        var drawControl = new L.Control.Draw({
            draw: {
                polyline: false,
                polygon: true,
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
            var polygon = layer.toGeoJSON();
            var latLngs = polygon.geometry.coordinates.map(function(coords) {
                return coords.reverse();
            });
            document.getElementById('geometry').value = JSON.stringify(latLngs);
            drawnItems.addLayer(layer);
        });
        // });
    </script>
@endpush
