<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Admin Super',
            'username' => 'administrator',
            'email'=>'admin@bayaran.id',
            'password'=>Hash::make('administrator')
        ]);

        DB::table('employees')->insert([
            'eid' => 10001,
            'email' => 'hendry@bayaran.id',
            'username' => 'hendry5',
            'password' => Hash::make('hendry5'),
            'name' => 'Admin Super',
            'city' => 'Jakarta',
            'domicile' => 'Jakarta Selatan',
            'place_birth' => 'Jakarta',
            'date_birth' => '1990-01-01',
            'blood_type' => 'O',
            'gender' => 'Laki-laki',
            'religion' => 'Islam',
            'marriage' => 'Belum Menikah',
            'education' => 'S1',
            'whatsapp' => '08123456789',
            'bank' => 'BCA',
            'bank_number' => '1234567890',
            'position_id' => 1,
            'job_title_id' => 1,
            'division_id' => 1,
            'department_id' => 1,
            'joining_date' => '2023-01-01',
            'employee_status' => 'Tetap',
            'sales_status' => 0,
            'pa_id' => 1,
            'kpi_id' => 1,
            'bobot_kpi' => 100,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
            'resignation' => 0,
        ]);
        
    }
}
