<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('address')->default('')->nullable();
            $table->string('phone')->default('')->nullable();
            $table->string('lat')->default('')->nullable();
            $table->string('lng')->default('')->nullable();
            $table->string('country')->default('')->nullable();
            $table->string('city')->default('')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('governorate_id')->unsigned()->nullable();
            $table->foreign('governorate_id')->references('id')->on('governorates')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('addresses');
    }
}
