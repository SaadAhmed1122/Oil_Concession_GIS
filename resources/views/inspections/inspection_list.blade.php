@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Inspection List</div>

                    <div class="card-body">
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
                                            <a href="{{ route('inspections.edit_inspection', ['inspection' => $inspection->inspection_id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('inspections.destroy', $inspection->inspection_id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this inspection?')">Delete</button>
                                            </form>
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
