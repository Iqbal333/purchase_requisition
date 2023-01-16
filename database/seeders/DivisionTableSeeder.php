<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->insert([
            [
                'division_name' => 'IT',
            ],
            [
                'division_name' => 'GA',
            ],
            [
                'division_name' => 'HRD',
            ],
            [
                'division_name' => 'Finace',
            ],
            [
                'division_name' => 'Marketing'
            ]
        ]);
    }
}
