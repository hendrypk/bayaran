{{-- <div class="modal fade" id="editPresence" tabindex="-1" aria-labelledby="modalPresence" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPresenceModalTitle">Edit Presence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPresenceForm" action="{{ route('presence.update.admin', $data->id) }}" method="POST">
                    @csrf   
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="eid" aria-label="Default select example" id="selectEmployee">
                                <option selected>Select Employee</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->eid }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>   

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">workDay</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="workDay" id="editWorkDaySelect">
                                @foreach($presence as $presence)    
                                    <option value="{{ $presence->work_day_id }}" {{ $presence->work_day_id ? 'selected' : '' }}>{{ $presence->work_day_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="date" class="form-control" id="selectDate" value="{{ old('date', $presence->date )}}">
                        </div>
                    </div>  
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Check In</label>
                        <div class="col-sm-9">
                            <input type="time" name="checkin" class="form-control" id="checkin">
                        </div>
                    </div>   

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Check Out</label>
                        <div class="col-sm-9">
                            <input type="time" name="checkout" class="form-control" id="checkout">
                        </div>
                    </div> 
                    
                    <div class="content-align-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal -->
<div class="modal fade" id="editPresence" tabindex="-1" aria-labelledby="editPresenceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPresenceLabel">Edit Presence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPresenceForm" action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="name" class="form-label">Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="date" class="form-label">Date</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="date" name="date" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="workDay" class="form-label">Work Day</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="workDay" id="workDay" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="checkin" class="form-label">Check In</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" id="checkin" name="checkin">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="checkout" class="form-label">Check Out</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" id="checkout" name="checkout">
                        </div>
                    </div>

                    <!-- Hidden input for ID -->
                    <input type="hidden" id="presenceId" name="id">
                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  