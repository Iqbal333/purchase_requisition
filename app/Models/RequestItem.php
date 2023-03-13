<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'division_id',
        'request_no',
        'description',
        'status'
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
