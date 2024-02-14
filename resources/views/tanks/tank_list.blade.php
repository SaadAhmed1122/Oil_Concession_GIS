@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Filter Tanks</div>
            <div class="card-body">
                <form method="GET" action="{{ route('tank.index') }}">
                    <div class="form-group">
                        <label for="concession_code">Filter by Concession:</label>
                        <select class="form-control" id="concession_code" name="concession_code">
                            <option value="">All</option>
                            @foreach ($concessions as $concession)
                                <option value="{{ $concession->concession_id }}"
                                    {{ request('concession_code') == $concession->concession_id ? 'selected' : '' }}>
                                    {{ $concession->concession_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h2>Tank List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tank ID</th>
                            <th>Well</th>
                            <th>Capacity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filteredTanks as $tank)
                            <tr>
                                <td>{{ $tank->tank_code }}</td>
                                <td>{{ $tank->well->well_code }}</td>
                                <td>{{ $tank->capacity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Map</h2>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13); // Set initial view
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Add markers for tanks
        @foreach ($filteredTanks as $tank)
            L.marker([{{ $tank->latitude }}, {{ $tank->longitude }}]).addTo(map);
            var wellCoordinates = JSON.parse('{{ $tank->polyline }}');
            var polygonOptions = {
                color: 'red',
                fillColor: 'red',
                fillOpacity: 0.4
            };
            var polygon = L.polygon(wellCoordinates, polygonOptions).addTo(map);
        @endforeach

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
            L.marker([well.latitude, well.longitude],{icon: greenIcon}).addTo(map);
        });
    </script>
@endsection
