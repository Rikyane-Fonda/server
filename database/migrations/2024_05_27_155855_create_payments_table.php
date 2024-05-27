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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->float('amount_payable');/*Montant due*/
            $table->float('payment_amount'); /*Montant payé, c'est-à-dire initialisé */
            $table->enum('payment_status', ['paid', 'unpaid', 'pending'])->default('pending');/*Status du paiement, en cours par défaut*/
            $table->float('remains')->nullable();/* Reste de paiement, nul si payé totalement*/
            $table->enum('payment_method', ['cash', 'card', 'cheque', 'transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
