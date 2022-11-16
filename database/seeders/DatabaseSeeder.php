<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrenciesSeeder::class);
        $this->call(SeederTablePermissions::class);
        $this->call(SeederTablePermissionsClients::class);
        $this->call(SeederTablePermissionsCompany::class);
        $this->call(SeederTablePermissionsInvoice::class);
        $this->call(SeederTablePermissionsVoucher::class);
        $this->call(VoucherStatusSeeder::class);
        $this->call(VoucherTypeSeeder::class);
        $this->call(SeederTablePermissionsReports::class);
        $this->call(SeederTablePermissionsNotes::class);
    }
}
