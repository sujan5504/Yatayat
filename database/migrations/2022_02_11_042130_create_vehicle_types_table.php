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
            $table->string('name',250);
            $table->boolean('is_active')->default(1);
            $table->string('remarks',500)->nullable();

            $table->timestamps();
        
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unique('name','uq_vehicle_types_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_type');
    }
}
