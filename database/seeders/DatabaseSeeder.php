<?php

namespace Database\Seeders;

// use App\Models\Role;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {      
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        DB::table('permissions')->insert([
            ['name' => 'view overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            ['name' => 'create overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            ['name' => 'update overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            ['name' => 'create employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            ['name' => 'update employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            ['name' => 'delete employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            ['name' => 'view employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            ['name' => 'create presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            ['name' => 'update presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            ['name' => 'delete presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            ['name' => 'view presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            ['name' => 'view presence summary', 'group_name' => 'presence summary', 'guard_name' => 'web'],
            ['name' => 'presence export', 'group_name' => 'presence export', 'guard_name' => 'web'],
            ['name' => 'export presence summary', 'group_name' => 'presence summary', 'guard_name' => 'web'],
            ['name' => 'create kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            ['name' => 'update kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            ['name' => 'delete kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            ['name' => 'view kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            ['name' => 'create pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            ['name' => 'update pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            ['name' => 'delete pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            ['name' => 'view pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            ['name' => 'view pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            ['name' => 'export-kpi', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            ['name' => 'export-pa', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            ['name' => 'export-final-grade', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            ['name' => 'create pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            ['name' => 'update pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            ['name' => 'delete pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            ['name' => 'view employee grade', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            ['name' => 'create sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            ['name' => 'update sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            ['name' => 'delete sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            ['name' => 'view sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            ['name' => 'create options', 'group_name' => 'options', 'guard_name' => 'web'],
            ['name' => 'update options', 'group_name' => 'options', 'guard_name' => 'web'],
            ['name' => 'delete options', 'group_name' => 'options', 'guard_name' => 'web'],
            ['name' => 'view options', 'group_name' => 'options', 'guard_name' => 'web'],
            ['name' => 'create work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            ['name' => 'update work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            ['name' => 'delete work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            ['name' => 'view work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            ['name' => 'delete overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            ['name' => 'create user', 'group_name' => 'user', 'guard_name' => 'web'],
            ['name' => 'update user', 'group_name' => 'user', 'guard_name' => 'web'],
            ['name' => 'delete user', 'group_name' => 'user', 'guard_name' => 'web'],
            ['name' => 'view user', 'group_name' => 'user', 'guard_name' => 'web'],
            ['name' => 'create role', 'group_name' => 'role', 'guard_name' => 'web'],
            ['name' => 'update role', 'group_name' => 'role', 'guard_name' => 'web'],
            ['name' => 'delete role', 'group_name' => 'role', 'guard_name' => 'web'],
            ['name' => 'view role', 'group_name' => 'role', 'guard_name' => 'web'],
            ['name' => 'overtime export', 'group_name' => 'presence export', 'guard_name' => 'web'],
            ['name' => 'view leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            ['name' => 'create leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            ['name' => 'update leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            ['name' => 'delete leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            ['name' => 'view lapor hr', 'group_name' => 'lapor hr', 'guard_name' => 'web',],
            ['name' => 'edit lapor hr', 'group_name' => 'lapor hr', 'guard_name' => 'web',],
            ['name' => 'view resignation', 'group_name' => 'resignation', 'guard_name' => 'web'],
            ['name' => 'create resignation', 'group_name' => 'resignation', 'guard_name' => 'web'],
            ['name' => 'update resignation', 'group_name' => 'resignation', 'guard_name' => 'web'],
            ['name' => 'delete resignation', 'group_name' => 'resignation', 'guard_name' => 'web'],
            ['name' => 'view position change', 'group_name' => 'position change', 'guard_name' => 'web'],
            ['name' => 'create position change', 'group_name' => 'position change', 'guard_name' => 'web'],
            ['name' => 'delete position change', 'group_name' => 'position change', 'guard_name' => 'web'],
            ['name' => 'update position change', 'group_name' => 'position change', 'guard_name' => 'web'],
            // ['name' => 'view overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            // ['name' => 'create overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            // ['name' => 'update overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            // ['name' => 'create employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            // ['name' => 'update employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            // ['name' => 'delete employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            // ['name' => 'view employee', 'group_name' => 'employee', 'guard_name' => 'web'],
            // ['name' => 'create presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            // ['name' => 'update presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            // ['name' => 'delete presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            // ['name' => 'view presence', 'group_name' => 'presence', 'guard_name' => 'web'],
            // ['name' => 'view presence summary', 'group_name' => 'presence summary', 'guard_name' => 'web'],
            // ['name' => 'presence export', 'group_name' => 'presence export', 'guard_name' => 'web'],
            // ['name' => 'export presence summary', 'group_name' => 'presence summary', 'guard_name' => 'web'],
            // ['name' => 'create kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            // ['name' => 'update kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            // ['name' => 'delete kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            // ['name' => 'view kpi', 'group_name' => 'kpi', 'guard_name' => 'web'],
            // ['name' => 'create pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            // ['name' => 'update pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            // ['name' => 'delete pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            // ['name' => 'view pa', 'group_name' => 'appraisal', 'guard_name' => 'web'],
            // ['name' => 'view pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            // ['name' => 'export-kpi', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            // ['name' => 'export-pa', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            // ['name' => 'export-final-grade', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            // ['name' => 'create pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            // ['name' => 'update pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            // ['name' => 'delete pm', 'group_name' => 'performance options', 'guard_name' => 'web'],
            // ['name' => 'view employee grade', 'group_name' => 'employee grade', 'guard_name' => 'web'],
            // ['name' => 'create sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            // ['name' => 'update sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            // ['name' => 'delete sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            // ['name' => 'view sales', 'group_name' => 'sales', 'guard_name' => 'web'],
            // ['name' => 'create options', 'group_name' => 'options', 'guard_name' => 'web'],
            // ['name' => 'update options', 'group_name' => 'options', 'guard_name' => 'web'],
            // ['name' => 'delete options', 'group_name' => 'options', 'guard_name' => 'web'],
            // ['name' => 'view options', 'group_name' => 'options', 'guard_name' => 'web'],
            // ['name' => 'create work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            // ['name' => 'update work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            // ['name' => 'delete work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            // ['name' => 'view work pattern', 'group_name' => 'work pattern', 'guard_name' => 'web'],
            // ['name' => 'delete overtime', 'group_name' => 'overtime', 'guard_name' => 'web'],
            // ['name' => 'create user', 'group_name' => 'user', 'guard_name' => 'web'],
            // ['name' => 'update user', 'group_name' => 'user', 'guard_name' => 'web'],
            // ['name' => 'delete user', 'group_name' => 'user', 'guard_name' => 'web'],
            // ['name' => 'view user', 'group_name' => 'user', 'guard_name' => 'web'],
            // ['name' => 'create role', 'group_name' => 'role', 'guard_name' => 'web'],
            // ['name' => 'update role', 'group_name' => 'role', 'guard_name' => 'web'],
            // ['name' => 'delete role', 'group_name' => 'role', 'guard_name' => 'web'],
            // ['name' => 'view role', 'group_name' => 'role', 'guard_name' => 'web'],
            // ['name' => 'overtime export', 'group_name' => 'presence export', 'guard_name' => 'web'],
            // ['name' => 'view leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            // ['name' => 'create leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            // ['name' => 'update leave', 'group_name' => 'leave', 'guard_name' => 'web'],
            // ['name' => 'delete leave', 'group_name' => 'leave', 'guard_name' => 'web']
        ]);
        
        // Create the role
        $role = Role::firstOrCreate([
            'name' => 'administrator',
            'guard_name' => 'web'
        ]);

        // Assign all permissions to the 'administrator' role
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        //Create user
        DB::table('users')->insert([
            'name'=>'Admin Super',
            'username' => 'administrator',
            'email'=>'admin@bayaran.id',
            'password'=>Hash::make('administrator')
        ]);

        //Assign role to users
        $user = User::find(1);
        $user->assignRole($role);
        DB::table('positions')->insert([
            ['name' => 'Chief Executive Officer'],
            ['name' => 'Chief Business Officer'],
            ['name' => 'Corporate Secretary'],
            ['name' => 'General Manager'],
            ['name' => 'Manager of Finance & Accounting'],
            ['name' => 'Manager of Operations'],
            ['name' => 'Manager of Marketing'],
            ['name' => 'Manager of HRGA'],
            ['name' => 'Head of Finishing'],
            ['name' => 'Head of PPIC'],
            ['name' => 'Head of Embroidery'],
            ['name' => 'Head of Sewing'],
            ['name' => 'Head of Cutting'],
            ['name' => 'Head of Screenprinting'],
            ['name' => 'Leader of Embroidery Design'],
            ['name' => 'Leader of Embroidery'],
            ['name' => 'Content Creator'],
            ['name' => 'Embroidery Designer Staff'],
            ['name' => 'Customer Service'],
            ['name' => 'Manager of Sales'],
            ['name' => 'Customer Care'],
            ['name' => 'Sales Administration'],
            ['name' => 'Warehouse Staff'],
            ['name' => 'Purchasing & Runner Staff'],
            ['name' => 'Staff GM'],
            ['name' => 'Operations Administration Staff'],
            ['name' => 'Screenprinting Operator'],
            ['name' => 'Asisten Rumah Tangga'],
            ['name' => 'Office Boy'],
            ['name' => 'Finance & Accounting Staff'],
            ['name' => 'Embroidery Operator'],
            ['name' => 'Cutting Operator'],
            ['name' => 'Sewing Operator'],
            ['name' => 'Finishing Operator'],
            ['name' => 'Warehouse Admin'],
            ['name' => 'Staff Khusus'],
            ['name' => 'Afdruk Operator'],
            ['name' => 'Screenprinting Helper'],
            ['name' => 'Sewing Line Operator'],
            ['name' => 'Designer Staff'],
            ['name' => 'Sewing Helper'],
            ['name' => 'Advertiser'],
            ['name' => 'Screenprinting Designer'],
            ['name' => 'Sewing Staff'],
            ['name' => 'HRGA Staff'],
        ]);
        

        //Create Job Title
        DB::table('job_titles')->insert([
            ['name' => 'Chief Level', 'section' => '1'],
            ['name' => 'Departement Manager', 'section' => '2'],
            ['name' => 'Division Head', 'section' => '3'],
            ['name' => 'Team Leader', 'section' => '4'],
            ['name' => 'Staff', 'section' => '5'],
            ['name' => 'Operator', 'section' => '6'],
        ]);

        //Create division
        DB::table('divisions')->insert([
            ['name' => 'Finishing'],
            ['name' => 'PPIC'],
            ['name' => 'Embroidery'],
            ['name' => 'Sewing'],
            ['name' => 'Cutting'],
            ['name' => 'Screenprinting'],
            ['name' => 'Design'],
            ['name' => 'Hospitality & Administration'],
            ['name' => 'Sewing Line'],
        ]);
        

        //Create department
        DB::table('departments')->insert([
            ['name' => 'C-Level'],
            ['name' => 'General'],
            ['name' => 'Finance & Accounting'],
            ['name' => 'Operation'],
            ['name' => 'Marketing'],
            ['name' => 'HRGA'],
            ['name' => 'Sales'],
        ]);
        

        //create employee status
        DB::table('employee_status')->insert([
            ['name' => 'Kontrak'],
            ['name' => 'Tetap'],
            ['name' => 'Harian Lepas'],
        ]);

        //Office location
        DB::table('office_locations')->insert([
            'name' => 'Jl. Kaliurang Km 12',
            'latitude' => -7.6686,
            'longitude' => 110.4119,
            'radius' => 100, 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //WorkDay
        $now = Carbon::now();

        $workDays = [
            ['name' => 'Berlaku', 'day' => 'monday',    'day_off' => 0, 'check_out' => '16:00:00', 'break_in' => '12:00:00', 'break_out' => '13:00:00'],
            ['name' => 'Berlaku', 'day' => 'tuesday',   'day_off' => 0, 'check_out' => '16:00:00', 'break_in' => '12:00:00', 'break_out' => '13:00:00'],
            ['name' => 'Berlaku', 'day' => 'wednesday', 'day_off' => 0, 'check_out' => '16:00:00', 'break_in' => '12:00:00', 'break_out' => '13:00:00'],
            ['name' => 'Berlaku', 'day' => 'thursday',  'day_off' => 0, 'check_out' => '18:00:00', 'break_in' => '12:00:00', 'break_out' => '13:00:00'],
            ['name' => 'Berlaku', 'day' => 'friday',    'day_off' => 0, 'check_out' => '16:00:00', 'break_in' => '11:30:00', 'break_out' => '13:00:00'],
            ['name' => 'Berlaku', 'day' => 'saturday',  'day_off' => 0, 'check_out' => '16:00:00', 'break_in' => '12:00:00', 'break_out' => '13:00:00'],
            ['name' => 'Berlaku', 'day' => 'sunday',    'day_off' => 1, 'check_out' => null,       'break_in' => null,      'break_out' => null],
        ];

        foreach ($workDays as $day) {
            DB::table('work_days')->insert([
                'name' => $day['name'],
                'day' => $day['day'],
                'day_off' => $day['day_off'],
                'tolerance' => 0,
                'arrival' => '07:45:00',
                'check_in' => '08:00:00',
                'check_out' => $day['check_out'],
                'break_in' => $day['break_in'],
                'break_out' => $day['break_out'],
                'break' => 0,
                'count_late' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => $day['day'] === 'sunday' ? $now : null,
            ]);
        }

        //Employee
        DB::table('employees')->insert([
            'eid' => 10002, 
            'email' => 'halo@hendrypk.my.id',
            'username' => 'hendry5',
            'password' => Hash::make('hendry5'),
            'name' => 'Hendry Putra Kurniawan',
            'city' => 'Magelang',
            'domicile' => 'Sardonoharjo Ngaglik, Sleman, Yogyakarta',
            'place_birth' => 'Magelang',
            'date_birth' => '1999-09-13',
            'blood_type' => 'B',
            'gender' => 'male',
            'religion' => 'islam',
            'marriage' => 'married',
            'education' => 'high_school',
            'whatsapp' => '085842233005',
            'bank' => 'Bank BCA',
            'bank_number' => '0601069627',
            'position_id' => 5, 
            'job_title_id' => 1,
            'joining_date' => '2020-02-01',
            'employee_status' => 2, 
            'sales_status' => 0,
            'pa_id' => null, 
            'kpi_id' => null,
            'bobot_kpi' => 0, 
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        //Employee Work Day
        DB::table('employee_work_day')->insert([
            'employee_id' => 1,
            'work_day_id' => 1,
            'created_at' => $now
        ]);

        //Employee Office Location
        DB::table('employee_office_location')->insert([
            'employee_id' => 1,
            'office_location_id' => 1,
            'created_at' => $now
        ]);
        
    }
}
