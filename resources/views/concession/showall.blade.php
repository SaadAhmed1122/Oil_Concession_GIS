@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Concession Details</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                {{-- <th>Geometry</th> --}}
                                <th>Map</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($concessions as $concession)
                            <tr>
                                <td>{{ $concession->id }}</td>
                                <td>{{ $concession->concession_name }}</td>
                                <td>
                                    <div id="map{{ $concession->id }}" style="width: 250px; height: 250px;"></div>
                                    <script>
                                        var map{{ $concession->id }} = L.map('map{{ $concession->id }}').setView([51.505, -0.09], 13);
                                        var geoJSON{{ $concession->id }} = {!! $concession->geometry !!};
                                        L.geoJSON(geoJSON{{ $concession->id }}).addTo(map{{ $concession->id }});
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                        }).addTo(map{{ $concession->id }});
                                    </script>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
