<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    // Méthode pour calculer le montant dû pour un employé
    public function calculateAmountPayable(Employee $employee)
    {
        // Récupérer le dernier enregistrement de salaire de l'employé(e)
        $salary = Salary::where('employee_id', $employee->id)->latest('start_date')->first();
        $baseSalary = $salary->base_salary ?? 0;
        $baseSalary = $salary->base_salary;
        $monthlyHours = $salary->monthly_hours;

        // Calculer le taux horaire de base
        $hourlyRate = $baseSalary / $monthlyHours;

        // Calculer le total des heures pointées (heures totales - heures de pause)
        $totalPointedHours = $employee->pointings()
                                  ->whereMonth('start_time', now()->month)
                                  ->sum(DB::raw('hours - pause_hours'));

        // Calculer le montant total des heures pointées
        $pointingAmount = $totalPointedHours * $hourlyRate;

        // Calculer le total des rémunérations
        $totalRemuneration = $employee->remunerations()->whereMonth('date', now()->month)->sum('amount');

        // Calculer le total des heures supplémentaires validées
        $totalOvertime = $employee->overtimes()->where('status', 'valid')->whereMonth('date', now()->month)->sum(DB::raw('hours * rate'));

        // Calculer le total des congés payés
        $totalPaidVacation = $employee->vacations()->where('status', 'paid')->whereMonth('start_date', now()->month)->sum(DB::raw('hours * rate'));

        // Calculer le montant total à payer
        $totalAmountPayable = $pointingAmount + $totalRemuneration + $totalOvertime + $totalPaidVacation;

        return $totalAmountPayable;
    }

    // Méthode pour créer un paiement mensuel pour un employé
    public function createMonthlyPayment(Employee $employee, $paymentAmount, $paymentMethod)
    {
        // Calculer le montant dû pour le paiement mensuel
        $amountPayable = $this->calculateAmountPayable($employee);

        // Déterminer le statut du paiement et le montant restant
        $paymentStatus = $paymentAmount >= $amountPayable ? 'paid' : 'pending';
        $remains = $paymentAmount >= $amountPayable ? null : $amountPayable - $paymentAmount;

        // Créer un enregistrement de paiement dans la base de données
        Payment::create([
            'employee_id' => $employee->id,
            'amount_payable' => $amountPayable,
            'payment_amount' => $paymentAmount,
            'payment_status' => $paymentStatus,
            'remains' => $remains,
            'payment_method' => $paymentMethod,
        ]);
    }
}
