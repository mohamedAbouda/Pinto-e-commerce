<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_admins', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('');
            $table->string('email',191)->unique();
            $table->string('password')->nullable();
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->foreign('merchant_id')->references('id')->on('merchants')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('primary')->default(0); //to define which admin is the original for no reason yet

            $table->rememberToken();
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
        Schema::dropIfExists('merchant_admins');
    }
}
