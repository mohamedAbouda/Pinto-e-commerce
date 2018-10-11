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
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('postal_code')->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('gift_card_id')->unsigned()->nullable();
            $table->foreign('gift_card_id')->references('id')->on('gift_cards')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('total_price' ,20 ,2)->defaule(0)->unsigned();
            $table->decimal('total_price_after_discount' ,20 ,2)->defaule(0)->unsigned();

            $table->string('payment_method')->default('cash')->nullable();
            $table->string('shipping_method_name')->nullable();
            $table->decimal('shipping_method_cost' ,20 ,2)->nullable();

            $table->text('dispute_comment')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->nullable();
            $table->text('address')->nullable();

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
