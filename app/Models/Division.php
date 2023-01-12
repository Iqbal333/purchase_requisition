<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';

    protected $fillable = [
        'division_name'
    ];

    public function employee()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function request_item()
    {
        return $this->hasMany('App\Models\RequestItem');
    }
}
