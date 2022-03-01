<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            
            $table->string('name',250);
            $table->string('email',250)->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique('email','uq_clients_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
