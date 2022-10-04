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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_name');
            $table->string('ruc');
            $table->string('phone');
            $table->string('movile');
            $table->string('email');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('postal_code');
            $table->string('entry');
            $table->text('description');
            $table->string('photo');            
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
        Schema::dropIfExists('companies');
    }
};
