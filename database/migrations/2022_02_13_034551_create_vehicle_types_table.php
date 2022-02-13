<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('last_row')->nullable();
            $table->integer('right_row')->nullable();
            $table->integer('right_column')->nullable();
            $table->integer('left_row')->nullable();
            $table->integer('left_column')->nullable();
            $table->integer('driver_side')->nullable();
            $table->boolean('is_active')->default(1);
            $table->text('remarks',500)->nullable();

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_type');
    }
}
