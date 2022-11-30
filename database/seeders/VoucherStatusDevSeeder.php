<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherStatusDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name' => 'Devuelto', 'gloss' => 'Dev'],
        ];

        foreach($status as $stat){
            DB::table('voucher_status')->insert($stat);
        };
    }
}
