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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_voucher');
            $table->foreign('id_voucher')->references('id')->on('voucher');

            $table->unsignedBigInteger('id_voucher_type');
            $table->foreign('id_voucher_type')->references('id')->on('voucher_type');
            $table->string('notes_serie');
            $table->string('notes_number');
            $table->string('notes_date');
            
            $table->unsignedBigInteger('id_voucher_status');
            $table->foreign('id_voucher_status')->references('id')->on('voucher_status');
            
            $table->unsignedBigInteger('id_currency');
            $table->foreign('id_currency')->references('id')->on('currencies');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

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
        Schema::dropIfExists('notes');
    }
};
