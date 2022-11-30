<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sp_reporte = "DROP PROCEDURE IF EXISTS `sp_reporte`;
                CREATE PROCEDURE `sp_reporte`()
                BEGIN
                    select date(v.voucher_date) as day_v, sum(d.price * d.quantity) as sum_days 
                    from voucher v inner join voucher_detail d on v.id = d.id_voucher 
                    where v.voucher_date > now() - INTERVAL 7 day 
                    and v.id_voucher_status not in ('3')
                    group by day_v order by day_v;
                END;";

        DB::unprepared($sp_reporte);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
