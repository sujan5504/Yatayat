<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->boolean('is_active')->default(1);
            $table->string('remarks',500)->nullable();

            $table->timestamps();
        
            $table->unique('name','uq_employee_types_name');
        });

        $seeder = new Database\Seeders\EmployeeTypeTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_types');
    }
}
