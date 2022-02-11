<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            
            $table->string('code',10);
            $table->string('name',250);
            $table->boolean('is_active')->default(1);
            $table->string('remarks',500)->nullable();

            $table->timestamps();
        
            $table->unique('code','uq_genders_code');
            $table->unique('name','uq_genders_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
}
