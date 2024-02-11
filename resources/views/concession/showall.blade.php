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
                                <th>Geometry</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($concessions as $concession)
                            <tr>
                                <td>{{ $concession->id }}</td>
                                <td>{{ $concession->concession_name }}</td>
                                <td>{{ $concession->geometry }}</td> <!-- Adjust this according to your data structure -->
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
