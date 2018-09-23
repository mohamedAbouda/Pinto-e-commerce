<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('gift_card_id')->unsigned()->nullable();
            $table->foreign('gift_card_id')->references('id')->on('gift_cards')->onUpdate('cascade')->onDelete('cascade');
            $table->double('total_price' , 12 ,2)->defaule(0)->unsigned();
            $table->double('total_price_after_discount' , 12 ,2)->defaule(0)->unsigned();
            $table->integer('status')->nullable();
            $table->text('dispute_comment')->nullable();
            // $table->string('address_street')->nullable();
            // $table->string('address_apartment')->nullable();
            // $table->string('town')->nullable();
            // $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            // $table->string('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
