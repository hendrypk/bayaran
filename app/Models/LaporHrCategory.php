<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporHrCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'created_at', 'updated_at', 'deleted_at'];
}
