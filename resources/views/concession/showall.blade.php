@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Concession Map</div>
                    <a href="{{ route('concessions.create') }}" class="btn btn-primary mb-3"
                        style="position:absolute;
                    right:5%;margin-top:0.5%">Create</a>
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var bounds = L.latLngBounds();

        @foreach ($concessions as $concession)
            var geometries = JSON.parse('{!! $concession->geometry !!}');
            var name = '{{ $concession->name }}'; // Assuming 'name' is the attribute containing the geometry name

            geometries.forEach(function(geometry) {
                console.log(geometry);
                var polygon = L.polygon(geometry).addTo(map);
                polygon.bindPopup(
                    '<b>ID:</b> {{ $concession->concession_id }}<br><b>Name:</b> {{ $concession->concession_name }}'
                    );
                bounds.extend(polygon.getBounds());
            });
        @endforeach

        map.fitBounds(bounds);



        // var featureGroup = L.featureGroup();


        // concessions.forEach(function(concession) {
        //     if (concession.geometry && concession.geometry.coordinates.length > 0) {
        //         var geoJSONData = {
        //             type: 'Feature',
        //             geometry: {
        //                 type: 'LineString',
        //                 coordinates: concession.geometry.coordinates
        //             }
        //         };
        //         var layer = L.geoJSON(geoJSONData, {
        //             style: function(feature) {
        //                 return {
        //                     color: "#ff0000",
        //                     weight: 5
        //                 };
        //             },
        //             onEachFeature: function(feature, layer) {
        //                 layer.bindPopup(
        //                     '<b>ID:</b> ' + concession.concession_id + '<br><b>Name:</b> ' +
        //                     concession.concession_name
        //                 );
        //             }
        //         }).addTo(featureGroup);
        //     } else {
        //         console.error('Invalid geometry for concession ID:', concession.concession_id);
        //     }
        // });
        // // console.log(fe);
        // featureGroup.addTo(map);


        // if (featureGroup.getLayers().length > 0) {
        //     var bounds = featureGroup.getBounds();
        //     if (bounds.isValid()) {
        //         console.log(bounds);
        //         map.fitBounds(bounds);
        //     } else {
        //         console.error('Feature group bounds are not valid.');
        //     }
        // } else {
        //     console.log('No valid features found in the feature group.');
        // }
    </script>
@endsection
