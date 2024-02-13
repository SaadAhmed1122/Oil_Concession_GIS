@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Insert Well</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('well.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="concession_code">Concession:</label>
                                <select class="form-control" id="concession_code" name="concession_code">
                                    <option value="">Select Concession</option>
                                    @foreach($concessions as $concession)
                                        <option value="{{ $concession->concession_id }}">{{ $concession->concession_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="monthly_production">Monthly Production:</label>
                                <input type="text" class="form-control" id="monthly_production"
                                    name="monthly_production">
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" name="latitude">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude:</label>
                                <input type="text" class="form-control" id="longitude" name="longitude">
                            </div>
                            <div id="map" style="width: 100%; height: 500px;"></div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
        map.on("click", function(e) {
            var latlng = e.latlng;
            var nearestPoint = null;
            marker
                .setLatLng(e.latlng)
                .addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(10);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(10);

        })
    </script>
@endsection
