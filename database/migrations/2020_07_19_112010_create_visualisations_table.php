<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisualisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visualisations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flat_id');
            $table->timestamps();

            $table->foreign('flat_id')
                ->references('id')
                ->on('flats')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visualisations');
    }
}
