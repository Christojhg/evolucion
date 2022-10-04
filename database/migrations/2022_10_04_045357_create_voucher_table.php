<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_voucher_type');
            $table->foreign('id_voucher_type')->references('id')->on('voucher_type');
            $table->string('voucher_serie');
            $table->string('voucher_number');
            $table->string('voucher_date');
            $table->unsignedBigInteger('id_voucher_status');
            $table->foreign('id_voucher_status')->references('id')->on('voucher_status');
            
            $table->unsignedBigInteger('id_currency');
            $table->foreign('id_currency')->references('id')->on('currencies');


            $table->unsignedBigInteger('id_companie');
            $table->foreign('id_companie')->references('id')->on('companies');


            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('clients');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher');
    }
};
