<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_assign', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('vehicle_detail_id');
            $table->string('departure_date')->nullable();
            $table->time('departure_time')->nullable();
            $table->unsignedBigInteger('from_id')->nullable();
            $table->unsignedBigInteger('to_id')->nullable();
            $table->integer('price');
            $table->jsonb('boarding_point')->nullable();
            $table->jsonb('dropping_point')->nullable();
            $table->unsignedBigInteger('driver_employee_id')->nullable();
            $table->unsignedBigInteger('conductor_employee_id')->nullable();

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types');
            $table->foreign('vehicle_detail_id')->references('id')->on('vehicle_details');
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
        Schema::dropIfExists('vehicles_assign');
    }
}
