<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) { //merchants
            $table->increments('id');
            $table->string('name');
            $table->string('email',191)->unique();
            // $table->string('password')->nullable();
            $table->string('phone')->default('');
            $table->string('mobile')->default('');
            $table->string('hot_line')->default('');
            $table->string('profile_pic')->default('');
            $table->string('created_by')->default('');
            $table->string('cover_pic')->default('');
            $table->text('bio')->nullable();
            $table->integer('corporate_deal_check')->default(0);
            // $table->string('social_type')->default('');
            // $table->string('social_id')->default('');

            // $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('approved')->default(0);
            $table->tinyInteger('type')->default(0);

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
        Schema::dropIfExists('merchants');
    }
}
