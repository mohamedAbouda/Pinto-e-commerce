<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('');
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->integer('governorate_id')->unsigned()->nullable();
            
            $table->foreign('merchant_id')->references('id')->on('merchants')
            ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('branches');
    }
}
