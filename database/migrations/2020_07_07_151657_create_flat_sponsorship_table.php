<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_sponsorship', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsorship_id');
            $table->foreignId('flat_id');
            $table->string('braintree_code');
            $table->date('start');
            $table->date('end');
            $table->timestamps();

            // relationships
            $table->foreign('sponsorship_id')
                ->references('id')
                ->on('sponsorships');
            $table->foreign('flat_id')
                ->references('id')
                ->on('flats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_sponsorship');
    }
}
