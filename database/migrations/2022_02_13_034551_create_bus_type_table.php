<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_type', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('back_row');
            $table->integer('right_row');
            $table->integer('back_column');
            $table->integer('left_row');
            $table->integer('left_column');
            $table->integer('driver_side');
            $table->boolean('is_active')->default(1);
            $table->text('remarks',500)->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('bus_type');
    }
}
