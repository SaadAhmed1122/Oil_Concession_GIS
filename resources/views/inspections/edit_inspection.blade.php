@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Inspection</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inspections.update', $inspection->inspection_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="estimation_date">Estimation Date</label>
                                <input id="estimation_date" type="date" class="form-control" name="estimation_date" value="{{ $inspection->estimation_date }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="Pending" {{ $inspection->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Completed" {{ $inspection->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $inspection->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Inspection</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
