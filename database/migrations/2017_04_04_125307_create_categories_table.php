<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('unicode')->nullable();
            $table->integer('navBar')->default(0);
            $table->integer('payment_withhold')->unsigned()->default(0);
            $table->integer('payment_due_percentage')->unsigned()->default(0);
            $table->integer('shipping_cost')->unsigned()->default(0);
            $table->boolean('has_size')->default(0);
            $table->boolean('has_color')->default(0);
            $table->boolean('has_brand')->default(0);
            $table->integer('key_word_id')->unsigned();
            $table->foreign('key_word_id')->references('id')->on('key_words')
            ->onDelete('cascade');

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
        Schema::dropIfExists('categories');
    }
}
