@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Concession Map</div>

                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([51.505, -0.09], 13); // Set initial view

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Create a feature group
        var featureGroup = L.featureGroup().addTo(map);

        // Encode all concessions to a JavaScript array
        var concessions = {!! json_encode($concessions->toArray()) !!};

        // Loop through the concessions and add them to the feature group
        concessions.forEach(function(concession) {
            if (concession.geometry && concession.geometry.coordinates.length > 0) {
                var geoJSONData = {
                    type: 'Feature',
                    geometry: {
                        type: 'LineString',
                        coordinates: concession.geometry
                            .coordinates // Ensure this is a valid array of [lng, lat] pairs
                    }
                };

                // Create GeoJSON layer
                var layer = L.geoJSON(geoJSONData, {
                    style: function(feature) {
                        return {
                            color: "#ff0000",
                            weight: 5
                        }; // Set the line color and weight
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(
                            '<b>ID:</b> ' + concession.concession_id + '<br><b>Name:</b> ' +
                            concession.concession_name
                        );
                    }
                }).addTo(featureGroup);
            } else {
                console.error('Invalid geometry for concession ID:', concession.concession_id);
            }
        });

        // Check if feature group has valid features before fitting bounds
        if (featureGroup.getLayers().length > 0) {
            var bounds = featureGroup.getBounds();
            if (bounds.isValid()) { // Check if bounds are valid before fitting
                console.log(bounds);
                map.fitBounds(bounds);
            } else {
                console.error('Feature group bounds are not valid.');
            }
        } else {
            console.log('No valid features found in the feature group.');
        }
    </script>
@endsection
