<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Boleta', 'gloss' => 'BOL'],
            ['name' => 'Factura', 'gloss' => 'FAC']
        ];

        foreach($types as $type){
            DB::table('voucher_type')->insert($type);
        };
    }
}
