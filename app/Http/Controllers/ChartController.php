<?php

namespace App\Http\Controllers;

use App\Models\RequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function engagement()
    {
        $engagement = RequestItem::select(DB::raw('MONTH(created_at) as monthKey'), DB::raw('count(*) as totalRequestItem'))
        ->groupBy('monthKey')
        ->get();


        return response()->json([
            'status' => true,
            'code' => 200,
            'results' => $engagement
        ], 200);
    }
}
