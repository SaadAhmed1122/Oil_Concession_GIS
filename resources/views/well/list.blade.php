@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Wells List</div>
                <a href="{{ route('well_productions.index') }}" class="btn btn-primary mb-3" style="position:absolute;right:0%;">Go to Production Page</a>
                <a href="{{ route('well.create') }}" class="btn btn-primary mb-3" style="position:absolute;
                right:20%;">Create</a>
                <div class="card-body">
                    <form method="GET" action="{{ route('well.list') }}">
                        <div class="form-group">
                            <label for="concession_code">Filter by Concession:</label>
                            <select class="form-control" id="concession_code" name="concession_code">
                                <option value="">All</option>
                                @foreach($concessions as $concession)
                                    <option value="{{ $concession->concession_id }}" {{ request('concession_code') == $concession->concession_id ? 'selected' : '' }}>{{ $concession->concession_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wells as $well)
                                <tr>
                                    <td>{{ $well->well_code }}</td>
                                    <td>{{ $well->latitude }}</td>
                                    <td>{{ $well->longitude }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div id="map" style="width: 100%; height: 400px;"></div>
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

    var wells = {!! json_encode($wells->toArray()) !!};
    console.log(wells);
    wells.forEach(function(well) {
        L.marker([well.latitude, well.longitude]).addTo(map);
    });
</script>
@endsection
