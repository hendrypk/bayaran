@php
    use Carbon\Carbon;
    $defaultStartDate = $startDate ?? Carbon::now()->startOfMonth()->format('Y-m-d');
    $defaultEndDate = $endDate ?? Carbon::now()->format('Y-m-d');
    $today = Carbon::now()->format('Y-m-d');
@endphp

<form method="GET" action="{{ $action }}" class="mb-3">
    <div class="row">
        <div class="col-md-2">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $defaultStartDate }}" max="{{ $today }}">
        </div>
        <div class="col-md-2">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $defaultEndDate }}" max="{{ $today }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-tosca mt-4">Filter</button>
        </div>
    </div>
</form>

{{-- 
<form action="{{ $action }}" method="GET">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="{{ $defaultStartDate }}">
    
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="{{ $defaultEndDate }}">
    
    <button type="submit">Filter</button>
</form> --}}