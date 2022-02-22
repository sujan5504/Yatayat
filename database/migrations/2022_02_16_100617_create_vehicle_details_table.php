<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->string('vehicle_number',20);
            $table->jsonb('amenities')->nullable();

            $table->timestamps();

            $table->unique(['vehicle_number','client_id'],'uq_vehicle_details_vehicle_number_client_id');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_details');
    }
}
