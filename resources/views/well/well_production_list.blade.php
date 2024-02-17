@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Well Production Data</h1>
            <a href="{{ route('well_productions.create') }}" class="btn btn-primary mb-3" style="position:absolute;
            right:10%;">Create</a>
        </div>
        <form action="{{ route('well_productions.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="well_code">Filter by Well Code:</label>
                        <select name="well_code" id="well_code" class="form-control">
                            <option value="">All</option>
                            @foreach ($wells as $well)
                                <option value="{{ $well->well_code }}"
                                    {{ request('well_code') == $well->well_code ? 'selected' : '' }}>{{ $well->well_code }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">Filter by Start Date:</label>
                        <input type="date" class="form-control" name="start_date" id="start_date"
                            value="{{ request('start_date') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_date">Filter by End Date:</label>
                        <input type="date" class="form-control" name="end_date" id="end_date"
                            value="{{ request('end_date') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Well Code</th>
                    <th>Monthly Production</th>
                    <th>Month</th>
                </tr>
            </thead>
            @foreach ($wellProductions as $production)
                <tr>
                    <td>{{ $production->well_id }}</td>
                    <td>{{ $production->monthly_production }}</td>
                    <td>{{ $production->month }}</td>
                </tr>
            @endforeach
            <!-- Total production row -->
            <tr>
                <td colspan="3" class="text-right"><strong>Total Production:</strong></td>
                <td>{{ $totalProduction }}:Kgs</td>
            </tr>
        </table>
    </div>
@endsection
