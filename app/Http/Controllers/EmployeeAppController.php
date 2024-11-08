<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\WorkDay;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeAppController extends Controller
{

//About
    public function about(){
        return view('_employee_app.about');
    }
//Dashboard
    public function index(){
        $employeeId = Auth::id();
        $employee = Employee::with('workDay')->findOrFail($employeeId);
        $workDay = $employee->workDay;
        return view('_employee_app.index', compact('employee', 'workDay'));
    }

//Create Presence
    public function create(){
        $employeeId = Auth::id();
        $employee = Employee::with('workDay')->findOrFail($employeeId);
        $workDay = $employee->workDay;
        return view('_employee_app.presence', compact('employee'));
    }

    public function imageStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|string'
        ]);

        // Extract base64 image string and decode it
        $imageData = $request->input('image');

        // Remove the data:image/jpeg;base64, part
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);

        // Decode base64 to binary
        $imageData = base64_decode($imageData);

        // Create unique file name
        $eid = Auth::id();
        $datePhoto = now()->toDateString();
        $timePhoto = now()->toTimeString();
        $fileName = $eid . '-' . $datePhoto . '-' . $timePhoto;

        // Save the image to storage/app/public folder
        $path = storage_path('app/public/presence/' . $fileName);
        file_put_contents($path, $imageData);

        return response()->json(['success' => 'Image saved successfully!']);
    }

//Calculate Presence Radius
function distance($lat1, $lon1, $lat2, $lon2){
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) +
             (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('meters', 'kilometers', 'miles');
}

//Store Presence
    public function store(Request $request){
        // $latOffice = -7.7022881;
        // $lonOffice = 110.3904715;
        $latOffice = -7.761940915549656;
        $lonOffice = 110.31390577561152;
        $loc = $request->input('location');
        $location = explode(',', $loc);
        $latUser = $location[0];
        $lonUser = $location[1];

        $distance = $this->distance($latOffice, $lonOffice, $latUser, $lonUser);
        $radius = round($distance["meters"]);
        $radiusKM = round($distance["kilometers"]);

        // $imageData = $request->input('image');

        $request->validate([
            'workDay' => 'required',
            'note' => 'required'
        ],[
            'workDay.required' => 'Shift is required!',
            'note.required' => 'Note is required!'
        ]);

        $employeeId = Auth::id();
        $eid = Auth::user()->eid;
        $employeeName = Auth::user()->name;
        $employee = Employee::with('workDay')->findOrFail($employeeId);
        $date = Carbon::parse(now()->toDateString());
        $datePhoto = now()->toDateString();
        $timePhoto = now()->toTimeString();
        $today = strtolower($date->format('l'));
        $workDay = WorkDay::where('name', $request->workDay)->where('day', $today)->first();
        $day_off = $workDay->day_off;
        $break = $workDay->break;
        $photo = $employeeId . '-' . $datePhoto . '-' . $timePhoto;

        if($radius > 20000) {
            $message = 'Ohh no... You are out of office. Your radius is ' . $radiusKM . ' km or your GPS location is malfunction!';
            return redirect()->back()->with('error', $message);
        } else {

        
        
        if($day_off == 1){
            $message = 'Today is Off Day for You';
            return redirect()->back()->with('error', $message);
        }

        $parseTime = function($time) {
            return $time && $time !== 'N/A' ? Carbon::parse($time) : null;
        };

        $arrival = $workDay ? $parseTime($workDay->arrival) : null;
        $check_in = $workDay ? $parseTime($workDay->check_in) : null;
        $check_out = $workDay ? $parseTime($workDay->check_out) : null;       
        $now = $parseTime (now()->toTimeString());
        $lateArrival = $now && $arrival ? ($arrival->diffInMinutes($now, false)> 1 ? 1 : 0) :0;
        $lateArrival = intval($lateArrival);
        $lateCheckIn = $now && $check_in ? max(intval($check_in->diffInMinutes($now, false)), 0) : '0';

            // Find existing presence for today
            $presence = Presence::where('employee_id', $employeeId)
            ->where('date', now()->toDateString())
            ->first();
            
            $message = '';

     
            // Switch case to handle presence states
            switch (true) {
                // Case when there is no presence record for today (Check-in)
                case is_null($presence):

                    $presence =Presence::create([
                            'employee_id' => $employeeId,
                            'eid' => $eid,
                            'employee_name' => $employeeName,
                            'work_day_id' => $request->workDay,
                            'date' => now()->toDateString(),
                            'check_in' => now()->toTimeString(),
                            'late_check_in' => $lateCheckIn,
                            'late_arrival' => $lateArrival,
                            'note_in' => $request->note,
                            'photo_in' => $photo,
                            'location_in' => $loc
                    ]);

                    $message = 'Check-in recorded successfully! But, you are late for ' . $lateCheckIn . ' minutes';
                    break;
        
                // Case when the employee has checked in but not checked out (Check-out)
                case !is_null($presence->check_in) && is_null($presence->check_out):
                    $lastedWorkDay = $presence->work_day_id;
                    $lastWorkDay = WorkDay::where('name', $lastedWorkDay)->where('day', $today)->first();
                    $forCheckOut = $lastWorkDay->check_out;
                  
                    if($now && $check_out){
                        $cutStart = Carbon::parse($check_out->format('Y-m-d' . ' 12:00:00 '));
                        $cutEnd = Carbon::parse($check_out->format('Y-m-d' . ' 13:00:00 '));
                        $excldueBreak = $break == 1;
            
                        switch(true) {
                            case $excldueBreak:
                                $checkOutEarly = max(intval($now->diffInMinutes($forCheckOut, false)), 0);
                                break;
            
                            case $now->lt($cutStart):
                                $checkOutEarly = max(intval($now->diffInMinutes($forCheckOut, false))-60, 0);
                                break;
                            
                            case $now->between($cutStart, $cutEnd):
                                $checkOutEarly = max(intval($cutEnd->diffInMinutes($forCheckOut, false)), 0);
                                break;

                            case $now->lt($check_in):
                                $checkOutEarly = 0;
                        
                            default:
                                $checkOutEarly = max(intval($now->diffInMinutes($forCheckOut, false)), 0);
                                break;
                        }
                    }
                    $presence->update([
                        'check_out' => now()->toTimeString(),
                        'check_out_early' => $checkOutEarly,
                        'note_out' => $request->note,
                        'photo_out' => $photo,
                        'location_out' => $loc
                    ]);

                    $message = 'Check-out recorded successfully! You left ' . $checkOutEarly . ' minutes early';
                    break;
        
                // Case when both check-in and check-out are already recorded
                case !is_null($presence->check_in) && !is_null($presence->check_out):
                    $message = 'You have already checked out for today. No further presence allowed.';
                    return redirect()->back()->with('error', $message);
                    break;
        
                // Default case to catch any unexpected scenarios
                default:
                    $message = 'Unexpected error occurred. Please try again later.';
                    return redirect()->back()->with('error', $message);
                    break;
            }
        }
        return redirect()->route('employee.app')->with('success', $message);
    }

//Presences History
    public function history(){
        $employeeId = Auth::id();
        $employee = Employee::findOrFail($employeeId);
        $presences = Presence::where('employee_id', $employeeId)->get();
        // dd($employeeId, $employee, $presences);
        return view('_employee_app.history', compact('presences'));
    }

//Overtime
    public function overtime(){
        $employeeId = Auth::id();
        $employee = Employee::with('workDay')->findOrFail($employeeId);
        $workDay = $employee->workDay;
        return view('_employee_app.overtime', compact('employee'));
    }

    public function overtimeStore(){
        $employeeId = Auth::id();
        $date = Carbon::parse(now()->toDateString());
        $today = strtolower($date->format('l'));

        //find existing overtime today
        $overtime = overtime::where('employee_id', $employeeId)
        ->where('date', $date)
        ->first();

        $parseTime = function($time) {
            return $time && $time !== 'N/A' ? Carbon::parse($time) : null;
        };

        $start_at = $overtime ? $parseTime ($overtime->start_at) : null ;
        $now = $parseTime (now()->toTimeString());
        $total_overtime = $now && $start_at ? max(intval($start_at->diffInMinutes($now, false)), 0) : '0';

        switch (true) {
            case is_null($overtime):
                $overtime = Overtime::create([
                    'employee_id' => $employeeId,
                    'date' => $date,
                    'start_at' => now()->toTimeString(),
                ]);
                $message = 'Overtime-in recorded successfully!';
                break;

            // Case when the employee has checked in but not checked out (Check-out)
            case !is_null($overtime->start_at) && is_null($overtime->end_at):
                $overtime->update([
                    'end_at' => now()->toTimeString(),
                    'total' => $total_overtime,
                    ]);
                $message = 'Overtime-out recorded successfully!';

            // Case when both check-in and check-out are already recorded
            case !is_null($overtime->start_at) && !is_null($overtime->end_at):
                $message = 'You have already overtime out for today. No further overtime allowed.';
                break;
        }

        return redirect()->route('employee.app')->with('message', $message);
    }
//Overtime History
    public function overtimeHistory(){
        $employeeId = Auth::id();
        $overtime = Overtime::where('employee_id', $employeeId)->get();

        return view('_employee_app.overtime-history', compact('overtime'));
    }

//Overtime
    public function profileIndex(){
        return view('_employee_app.profile.index');
    }

//Reset username
    public function resetUsername(){
        return view('_employee_app.profile.username');
    }

    public function resetUsernameStore(Request $request){
        $request->validate([
            'username' => 'required|string|regex:/^\S*$/|unique:employees,username',
            'currentPassword' => 'required|string',
        ],[
            'username.required' => 'please fill the username',
            'username.regex:/^\S*$/' => 'username contains invalid character',
            'username.unique' => 'username already exist',
        ]);

        $username = $request->username;
        $password = Hash::make($request->currentPassword);
        $passwordCheck = Hash::make(Auth::user()->password);

        if (Hash::check($password, $passwordCheck)){
            $employee = Auth::user();
            $employee->update([
                'username' => $username,
            ]);
            session()->flash('success', 'Username updated successfully!');
        } else {
            session()->flash('error', 'Password is incorrect. Please reenter the current password!');
        }

        return redirect()->route('change.username')->withInput();
    }

//Reset Password
    public function resetPassword(){
        return view('_employee_app.profile.password');
    }

    public function resetPasswordStore(Request $request){
        $request->validate([
            'newPassword' => 'required|string|min:6',
            'confirmPassword' => 'required|string|min:6'
        ],[
            'newPassword.required' => 'New password is required!',
            'newPassword.min' => 'Minimum password 6 characters!',
            'confirmPassword' => 'Confirm new password is required!'
        ]);

        $password = $request->currentPassword;
        $passwordCheck = Auth::user()->password;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        if (Hash::check($password, $passwordCheck)){
            session()->flash('success', 'Username updated successfully!');
            if(Hash::make($newPassword === $confirmPassword)){
                $employee = Auth::user();
                $employee->update([
                    'password' => $confirmPassword
                ]);
            } else {
                session()->flash('error', 'Password does not match. Please reenter the current password!');
            }
        } else {
            session()->flash('error', 'Current password is incorrect. Please reenter the current password!');
        }
        return redirect()->route('change.password')->withInput();
    }
}
