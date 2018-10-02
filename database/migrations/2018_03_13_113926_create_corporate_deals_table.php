<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_deals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('first_product_id')->unsigned()->nullable();
            $table->foreign('first_product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('second_product_id')->unsigned()->nullable();
            $table->foreign('second_product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

            $table->float('discount')->defualt(0);
            $table->integer('approved')->defualt(0);
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
        Schema::dropIfExists('corporate_deals');
    }
}
