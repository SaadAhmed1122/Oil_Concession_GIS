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

        @foreach ($concessions as $concession)
            @if ($concession->geometry)
                // Log GeoJSON data for debugging
                var geoJSONData{{ $concession->id }} = {!! json_encode([
                    'type' => 'Feature',
                    'geometry' => ['type' => 'LineString', 'coordinates' => $concession->geometry->toArray()],
                ]) !!};
                console.log('GeoJSON data for concession {{ $concession->id }}:', geoJSONData{{ $concession->id }});

                // Create GeoJSON layer
                try {
                    var layer = L.geoJSON(geoJSONData{{ $concession->id }}, {
                        onEachFeature: function(feature, layer) {
                            layer.bindPopup(
                                '<b>ID:</b> {{ $concession->id }}<br><b>Name:</b> {{ $concession->concession_name }}'
                                );
                        }
                    });
                    featureGroup.addLayer(layer);

                    // Log the coordinates of the GeoJSON layer
                    console.log('Coordinates of GeoJSON layer:', {!! json_encode($concession->geometry->toArray()) !!});
                } catch (error) {
                    console.error('Error adding GeoJSON layer:', error);
                }
            @endif
        @endforeach

        // Check if feature group has valid features before fitting bounds
        if (featureGroup.getLayers().length > 0) {
            // Log the bounds of the feature group
            console.log('Bounds of feature group:', featureGroup.getBounds());

            // Calculate bounds manually based on individual feature coordinates
            var groupBounds = null;
            featureGroup.eachLayer(function(layer) {
                if (!groupBounds) {
                    groupBounds = layer.getBounds();
                } else {
                    groupBounds.extend(layer.getBounds());
                }
            });

            // Fit map bounds to the calculated bounds
            try {
                if (groupBounds) {
                    map.fitBounds(groupBounds);
                } else {
                    console.error('Error calculating group bounds: No valid features found.');
                }
            } catch (error) {
                console.error('Error fitting bounds:', error);
            }
        } else {
            console.log('No valid features found in the feature group.');
        }
    </script>
@endsection
