<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->integer('department_id');
            $table->string('name');
            $table->string('surname');
            $table->string('national_ID_card');
            $table->string('email');
            $table->string('adress');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('Telephone');
            $table->dateTime('hiring_date');
            $table->dateTime('departure_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
