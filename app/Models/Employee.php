<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'division_id',
        'position_name',
        'nik',
        'employee_name',
        'phone_number',
        'address'
    ];

    public function division()
    {
        return $this->belongsTo('App\Models\Division', 'division_id', 'id');
    }
}
