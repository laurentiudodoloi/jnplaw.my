<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSectionIdToAboutUsSectionTextBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_section_text_boxes', function (Blueprint $table) {
            $table->integer('section_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us_section_text_boxes', function (Blueprint $table) {
            $table->dropColumn('section_id');
        });
    }
}
