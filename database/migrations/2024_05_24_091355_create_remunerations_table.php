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
        Schema::create('remunerations', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->double('montant');
            $table->double('bonus');
            $table->double('pime');
            $table->string('motif_prime');
            $table->double('deduction');
            $table->string('motif_deduction');
            $table->string('period'); // this is the format: month/year
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remunerations');
    }
};
