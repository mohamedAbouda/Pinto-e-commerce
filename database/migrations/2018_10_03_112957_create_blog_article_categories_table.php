<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('blog_article_id')->unsigned()->nullable();
            $table->foreign('blog_article_id')->references('id')->on('blog_articles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('blog_category_id')->unsigned()->nullable();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('blog_article_categories');
    }
}
