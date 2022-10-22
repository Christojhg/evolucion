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
        $sp_salesclients = "DROP PROCEDURE IF EXISTS `sp_salesclients`;
                CREATE PROCEDURE `sp_salesclients`()
                BEGIN
                    select c.name, SUM(d.quantity * d.price) as ventas from 
                    voucher_detail d inner join voucher v on d.id_voucher = v.id inner join clients c on c.id = v.id_client 
                    GROUP by c.name 
                    ORDER BY ventas 
                    DESC limit 3;
                END;";

        DB::unprepared($sp_salesclients);
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
