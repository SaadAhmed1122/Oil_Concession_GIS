@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Inspection</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inspections.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select id="type" class="form-control" name="type" required autofocus>
                                    <option value="concession">Concession</option>
                                    <option value="well">Well</option>
                                    <option value="tank">Tank</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inspection_date">Inspection Date</label>
                                <input id="inspection_date" type="date" class="form-control" name="inspection_date" required>
                            </div>

                            <div class="form-group" id="resolution_time_field">
                                <label for="resolution_time">Expected Resolution Time</label>
                                <input id="resolution_time" type="date" class="form-control" name="resolution_time">
                            </div>

                            <div class="form-group" id="concession_code_field" style="display: none;">
                                <label for="concession_code">Concession Code</label>
                                <select id="concession_code" class="form-control" name="concession_code">
                                    <option value="">Select Concession</option>
                                    @foreach($concessions as $concession)
                                        <option value="{{ $concession->concession_id }}">{{ $concession->concession_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="well_code_field" style="display: none;">
                                <label for="well_code">Well Code</label>
                                <select id="well_code" class="form-control" name="well_code">
                                    <option value="">Select Well</option>
                                    @foreach($wells as $well)
                                        <option value="{{ $well->well_code }}">{{ $well->well_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="tank_code_field" style="display: none;">
                                <label for="tank_code">Tank Code</label>
                                <select id="tank_code" class="form-control" name="tank_code">
                                    <option value="">Select Tank</option>
                                    @foreach($tanks as $tank)
                                        <option value="{{ $tank->tank_code }}">{{ $tank->tank_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Inspection</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('type').addEventListener('change', function() {
            var type = this.value;

            // Hide all fields
            document.getElementById('concession_code_field').style.display = 'none';
            document.getElementById('well_code_field').style.display = 'none';
            document.getElementById('tank_code_field').style.display = 'none';

            // Show the relevant field based on the selected type
            if (type === 'concession') {
                document.getElementById('concession_code_field').style.display = 'block';
            } else if (type === 'well') {
                document.getElementById('well_code_field').style.display = 'block';
            } else if (type === 'tank') {
                document.getElementById('tank_code_field').style.display = 'block';
            }


        });
    </script>
@endsection
