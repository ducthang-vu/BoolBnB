<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedTinyInteger('number_of_rooms');
            $table->unsignedTinyInteger('number_of_beds');
            $table->unsignedTinyInteger('number_of_bathrooms');
            $table->unsignedTinyInteger('square_meters');
            $table->string('address');
            $table->string('image');
            $table->integer('visualisations')->default(0);
            $table->float('lat', 6, 4);
            $table->float('lng', 7, 4);
            // $table->point('geolocation');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}

