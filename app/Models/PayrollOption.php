<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollOption extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payroll_options';
    protected $fillable = [
        'eid',
        'name',
        'basic',
        'health',
        'meal',
        'dicipline',
        'performance',
        'comission',
        'overtime',
        'uang_pisah',
        'leave_cahsed',
        'absence',
        'lateness',
        'meal_deduction',
        'dicipline_deduction',
        'check_out_early',
        'penalty',
        'comission_deduction',
        'loan',
        'sallary_adjustment',
        'kpi_percent',
        'pa_percent',
    ];
    protected $dates = ['deleted_at']; 

}
