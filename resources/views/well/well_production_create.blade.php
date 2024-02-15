@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Insert Well Production</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('well_productions.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="well_id">Well:</label>
                                <select class="form-control" id="well_id" name="well_id">
                                    <option value="">Select Well</option>
                                    @foreach($wells as $well)
                                        <option value="{{ $well->well_code }}">{{ $well->well_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="monthly_production">Monthly Production:</label>
                                <input type="text" class="form-control" id="monthly_production"
                                    name="monthly_production">
                            </div>

                            <div class="form-group">
                                <label for="month">Production Date</label>
                                <input id="month" type="date" class="form-control" name="month" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
