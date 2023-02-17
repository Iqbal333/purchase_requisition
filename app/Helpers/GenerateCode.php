<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class GenerateCode
{
    public static function invoiceNumber()
    {
        $initial = 'INV-AIAM-'.date('Y-m').'-';
        $q = DB::table('requests')->select(DB::raw('MAX(RIGHT(request_no, 4)) as kd_max'))->where('request_no', 'like', '%' . $initial . '%');

        if($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = (int) substr($k->kd_max, -3, 3);
                $no = $tmp + 1;
                $kd = $initial . sprintf("%04s", $no);
            }
        } else {
            $kd = $initial . "0001";
        }
        return $kd;
    }
}
