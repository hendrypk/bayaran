@extends('_layout.main')
@section('title', 'Edit Work Day')
@section('content')

<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="card-title">Edit Work Day of {{ $workDays->first()->name }}</h5>
                </div>
            </div> 
                 
            <form action="{{ route('workDay.update', $workDays->first()->name) }}" method="POST">
                @csrf
                @method('POST')
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="name" class="fw-bold">Name</label>
                        <span>: </span>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" value="{{ $workDays->first()->name }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="tolerance" class="fw-bold">Tolerance</label>
                        <span>: </span>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="tolerance" value="{{ $workDays->first()->tolerance }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <table class="table datatable table-hover">
                        <thead class="table-primary">
                            <th>Day</th>
                            <th>Day Off</th>
                            <th>Arrival</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Exclude Break</th>
                        </thead>
                        <tbody>
                        @foreach($workDays as $workDay)
<tr>
    <td>{{ ucfirst($workDay->day) }}</td>
    <td>
        <input type="checkbox" id="{{ $workDay->day }}-dayOff" name="dayOff[{{ $workDay->day }}]" value="1" {{ $workDay->day_off == 1 ? 'checked' : '' }}>
    </td>
    <td>
        <input type="time" id="{{ $workDay->day }}-arrival" class="form-control" name="arrival[{{ $workDay->day }}]" value="{{ $workDay->arrival }}" {{ $workDay->day_off == 1 ? 'disabled' : '' }}>
    </td>
    <td>
        <input type="time" id="{{ $workDay->day }}-checkIn" class="form-control" name="checkIn[{{ $workDay->day }}]" value="{{ $workDay->check_in }}" {{ $workDay->day_off == 1 ? 'disabled' : '' }}>
    </td>
    <td>
        <input type="time" id="{{ $workDay->day }}-checkOut" class="form-control" name="checkOut[{{ $workDay->day }}]" value="{{ $workDay->check_out }}" {{ $workDay->day_off == 1 ? 'disabled' : '' }}>
    </td>
    <td>
    <div>
            <label>
                <input type="radio" name="break[{{ $workDay->day }}]" value="1" {{ $workDay->break == 1 ? 'checked' : '' }} {{ $workDay->day_off == 1 ? 'disabled' : '' }}>
                Yes
            </label>
            <label>
                <input type="radio" name="break[{{ $workDay->day }}]" value="0" {{ $workDay->break == 0 ? 'checked' : '' }} {{ $workDay->day_off == 1 ? 'disabled' : '' }}>
                No
            </label>
        </div>

    </td>
</tr>
@endforeach

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-tosca">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
<script>document.addEventListener('DOMContentLoaded', function () {
    // Define the function globally
    function toggleTimeInputs(day) {
        const isDayOff = document.querySelector(`input[id="${day}-dayOff"]`).checked;

        document.querySelector(`input[id="${day}-arrival"]`).disabled = isDayOff;
        document.querySelector(`input[id="${day}-checkIn"]`).disabled = isDayOff;
        document.querySelector(`input[id="${day}-checkOut"]`).disabled = isDayOff;
        document.querySelectorAll(`input[name="break[${day}]"]`).forEach(radio => radio.disabled = isDayOff);
    }

    // Bind change event for all checkboxes
    document.querySelectorAll('input[type=checkbox]').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const day = checkbox.id.split('-')[0]; // Extract the day from the checkbox ID
            toggleTimeInputs(day); // Call the function on checkbox change
        });

        // Trigger change event on page load to set the initial state
        checkbox.dispatchEvent(new Event('change'));
    });
});

    
</script>
@endsection

@endsection