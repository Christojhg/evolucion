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
        $sp_masvendido = "DROP PROCEDURE IF EXISTS `sp_masvendido`;
                CREATE PROCEDURE `sp_masvendido`()
                BEGIN
                    select p.name, SUM(v.quantity) as cantidad from 
                    voucher_detail v inner join products p on v.id_prod = p.id
                    inner join voucher vo on vo.id = v.id_voucher
                    where not vo.id_voucher_status = '3' 
                    GROUP BY p.name 
                    ORDER BY cantidad DESC limit 5;
                END;";

        DB::unprepared($sp_masvendido);
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
