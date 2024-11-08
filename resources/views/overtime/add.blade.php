<!-- Add Modal Position -->
<div class="modal fade" id="addOvertime" tabindex="-1" aria-labelledby="modalPosition" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOvertime">Add Overtime</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('overtime.add') }}" method="POST">
                    
                    @csrf
                    <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">EID</label>
                        <div class="col-sm-10">
                            <input type="text" name="eid" class="form-control">
                        </div>
                    </div> -->


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="employee_id" aria-label="Default select example">
                                <option selected>Select Employee</option>
                                @foreach($employees as $employee)
                                <option selected value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>   

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="date" class="form-control" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>  
                    
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Start at</label>
                        <div class="col-sm-10">
                            <input type="time" name="start" class="form-control">
                        </div>
                    </div>   

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">End at</label>
                        <div class="col-sm-10">
                            <input type="time" name="end" class="form-control">
                        </div>
                    </div> 

                    <button type="submit" class="btn btn-tosca">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

