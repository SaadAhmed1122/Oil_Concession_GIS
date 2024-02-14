@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inspections List</h1>

        <form action="{{ route('inspections.index') }}" method="GET" class="mb-3">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" name="start_date" id="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" name="end_date" id="end_date">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="concession">Concession:</label>
                        <select name="concession" id="concession" class="form-control">
                            <option value="">All</option>
                            @foreach ($concessions as $concession)
                                <option value="{{ $concession->concession_id }}">{{ $concession->concession_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="well">Well:</label>
                        <select name="well" id="well" class="form-control">
                            <option value="">All</option>
                            @foreach ($wells as $well)
                                <option value="{{ $well->well_code }}">{{ $well->well_code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tank">Tank:</label>
                        <select name="tank" id="tank" class="form-control">
                            <option value="">All</option>
                            @foreach ($tanks as $tank)
                                <option value="{{ $tank->tank_code }}">{{ $tank->tank_code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

    <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Inspection Date</th>
                <th>Status</th>
                <th>Resolution Time</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inspections as $inspection)
                <tr>
                    <td>{{ $inspection->type }}</td>
                    <td>{{ $inspection->inspection_date }}</td>
                    <td>{{ $inspection->status }}</td>
                    <td>{{ $inspection->resolution_time }}</td>
                    <td>{{ $inspection->description }}</td>
                    <td>
                        <a href="{{ route('inspections.edit_inspection', ['inspection' => $inspection->inspection_id]) }}"
                            class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('inspections.destroy', $inspection->inspection_id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this inspection?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
