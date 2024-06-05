<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class PointingService
{
    // Méthode pour calculer le nombre d'heures pointées pour un employée dans un mois donné
    public function calculateMonthlyPointingHours(Employee $employee, $month, $year)
    {
        // Récupérer tous les pointages de l'employée pour le mois et l'année spécifiés
        $pointings = $employee->pointings()
                          ->whereMonth('start_time', $month)
                          ->whereYear('start_time', $year)
                          ->get();

        $totalHours = 0;

        // Calculer le nombre total d'heures pointées
        foreach ($pointings as $pointing) {
            $totalHours += $pointing->hours;
        }

        return $totalHours;
    }
}
