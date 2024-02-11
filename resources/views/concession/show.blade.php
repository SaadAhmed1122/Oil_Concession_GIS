@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Concession Details</div>

                <div class="card-body">
                    <h2>{{ $concession->concession_name }}</h2>
                    <p><strong>Geometry:</strong></p>
                    <pre>{{ json_encode($concession->geometry, JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
