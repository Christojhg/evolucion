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
        Schema::create('voucher_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_voucher');
            $table->foreign('id_voucher')->references('id')->on('voucher');
            
            $table->unsignedBigInteger('id_prod');
            $table->foreign('id_prod')->references('id')->on('products');

            $table->integer('quantity');
            $table->decimal('price');
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
        Schema::dropIfExists('voucher_detail');
    }
};
