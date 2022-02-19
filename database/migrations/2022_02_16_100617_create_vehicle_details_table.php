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
            $table->unsignedBigInteger('driver_employee_id')->nullable();
            $table->unsignedBigInteger('conductor_employee_id')->nullable();
            $table->jsonb('amenities')->nullable();
            $table->jsonb('boarding_point');
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');

            $table->timestamps();

            $table->unique(['vehicle_number','client_id'],'uq_vehicle_details_vehicle_number_client_id');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types');
            $table->foreign('driver_employee_id')->references('id')->on('employees');
            $table->foreign('conductor_employee_id')->references('id')->on('employees');
            $table->foreign('from_id')->references('id')->on('destinations');
            $table->foreign('to_id')->references('id')->on('destinations');
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
