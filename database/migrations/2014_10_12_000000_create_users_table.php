<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { //admins
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('national_id')->nullable();
            $table->date('start_date')->nullable();
            $table->string('email',191)->unique();
            $table->string('password')->nullable();
            $table->string('phone')->default('');
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->string('profile_pic');
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
        Schema::dropIfExists('users');
    }
}
