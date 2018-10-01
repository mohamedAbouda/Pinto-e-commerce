<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('description_section_1_image')->nullable()->after('name');
            $table->string('description_section_1_head')->nullable()->after('description_section_1_image');
            $table->text('description_section_1_text')->nullable()->after('description_section_1_head');

            $table->string('description_section_2_image')->nullable()->after('description_section_1_text');
            $table->string('description_section_2_head_1')->nullable()->after('description_section_2_image');
            $table->text('description_section_2_text_1')->nullable()->after('description_section_2_head_1');

            $table->string('description_section_2_head_2')->nullable()->after('description_section_2_text_1');
            $table->text('description_section_2_text_2')->nullable()->after('description_section_2_head_2');

            $table->string('description_section_2_head_3')->nullable()->after('description_section_2_text_2');
            $table->text('description_section_2_text_3')->nullable()->after('description_section_2_head_3');

            $table->string('description_section_2_head_4')->nullable()->after('description_section_2_text_3');
            $table->text('description_section_2_text_4')->nullable()->after('description_section_2_head_4');

            $table->string('description_section_3_image')->nullable()->after('description_section_2_text_4');
            $table->string('description_section_3_head')->nullable()->after('description_section_3_image');
            $table->text('description_section_3_text')->nullable()->after('description_section_3_head');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
