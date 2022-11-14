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
        $sp_reporteventas = "DROP PROCEDURE IF EXISTS `sp_reporteventas`;
                CREATE PROCEDURE `sp_reporteventas`(IN start_date DATE, IN end_date DATE)
                BEGIN
                    if (start_date = '1000-01-01' and end_date = '1000-01-01') or (start_date > end_date) THEN
                        select v.id, v.voucher_serie, vt.name as type_name, c.name as client_name, v.voucher_date, vs.name as status_name, SUM(vd.price * vd.quantity) as monto from voucher v 
                        inner join voucher_detail vd on v.id = vd.id_voucher
                        inner join clients c on v.id_client = c.id
                        inner join voucher_status vs on v.id_voucher_status = vs.id
                        inner join voucher_type vt on v.id_voucher_type = vt.id
                        group by v.id, v.voucher_serie, type_name, client_name, v.voucher_date, status_name;   
                    else
                        select v.id, v.voucher_serie, vt.name as type_name, c.name as client_name, v.voucher_date, vs.name as status_name, SUM(vd.price * vd.quantity) as monto from voucher v 
                        inner join voucher_detail vd on v.id = vd.id_voucher
                        inner join clients c on v.id_client = c.id
                        inner join voucher_status vs on v.id_voucher_status = vs.id
                        inner join voucher_type vt on v.id_voucher_type = vt.id
                        where v.voucher_date BETWEEN start_date AND end_date
                        group by v.id, v.voucher_serie, type_name, client_name, v.voucher_date, status_name;
                    end if;            
                END;";

        DB::unprepared($sp_reporteventas);
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
