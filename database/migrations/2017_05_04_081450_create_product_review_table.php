<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_review', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('cascade');
            $table->string('name')->default('');
            $table->text('review')->default('');
            $table->integer('rate')->default(0);
            $table->integer('approved')->default(0);

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
        Schema::dropIfExists('product_review');
    }
}
