<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('full_name',250);
            $table->unsignedBigInteger('employee_type_id')->nullable();
            $table->string('license_number',100)->nullable(); 
            $table->text('issued_date_bs')->nullable(); 
            $table->text('issued_date_ad')->nullable(); 
            $table->string('employee_photo',250)->nullable(); 
            $table->string('license_photo',250)->nullable(); 
            $table->string('contact',20); 
            $table->unsignedBigInteger('gender_id');
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(1);

            $table->timestamps();
            
            $table->unique(['license_number','client_id'],'uq_employees_license_number_client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('employee_type_id')->references('id')->on('employee_types');
            $table->foreign('gender_id')->references('id')->on('genders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
