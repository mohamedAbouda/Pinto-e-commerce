<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) { //clients
            $table->increments('id');
            $table->string('name');
            $table->string('email',191)->unique();
            $table->string('password')->nullable();
            $table->string('phone')->default('');
            $table->string('profile_pic')->default('');
            $table->string('social_type')->default('');
            $table->string('social_id')->default('');

            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('valid');
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
        Schema::dropIfExists('clients');
    }
}
