<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'request_id',
        'item',
        'unit_price',
        'qty',
        'total',
        'remark'
    ];

    public function request_item()
    {
        return $this->belongsTo('App\Models\RequestItem');
    }
}
