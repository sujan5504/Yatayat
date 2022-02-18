<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('name',250);
            $table->boolean('is_active')->default(1);
            $table->string('remarks',500)->nullable();

            $table->timestamps();
        
            $table->unique(['name','client_id'],'uq_vehicles_name_client_id');
            $table->foreign('client_id')->references('id')->on('clients');
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
