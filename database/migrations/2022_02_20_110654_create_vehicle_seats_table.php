<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_seats', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('vehicle_detail_id');
            $table->string('date');

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types');
            $table->foreign('vehicle_detail_id')->references('id')->on('vehicle_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_seats');
    }
}
