<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name' => 'Enviado', 'gloss' => 'Env'],
            ['name' => 'No Enviado', 'gloss' => 'No Env']
        ];

        foreach($status as $stat){
            DB::table('voucher_status')->insert($stat);
        };

        
    }
}
