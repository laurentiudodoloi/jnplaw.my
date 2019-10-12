<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('element', ['logo']);
            $table->enum('fixed_width', [
                'gt_1200', // extra-large
                'gt_992', // large
                'gt_768', // medium
                'gt_576', // small
                'lt_576', // extra-small
            ]);
            $table->float('width');
            $table->float('height');
            $table->enum('unit', ['px']);
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
        Schema::dropIfExists('layout_sizes');
    }
}
