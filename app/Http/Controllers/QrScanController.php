<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Pointing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class QrScanController extends Controller
{
    // Méthode pour gérer le scan du QR code
    public function scan(Request $request)
    {
        // Valider l'entrée pour s'assurer que nous avons un ID employée valide
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $employeeId = $request->input('employee_id');

        // Récupérer l'employée par ID
        $employee = Employee::findOrFail($employeeId);

        // Vérifier si l'employée a un pointage en cours (sans end_time)
        $ongoingPointing = Pointing::where('employee_id', $userId)
                                    ->whereNull('end_time')
                                    ->first();

        if ($ongoingPointing) {
            // Si un pointage est en cours, terminer ce pointage
            $ongoingPointing->end_time = Carbon::now();
            $ongoingPointing->calculateHours(); // Calculer les heures et sauvegarder
        } else {
            // Sinon, créer un nouveau pointage
            Pointing::create([
                'employee_id' => $userId,
                'start_time' => Carbon::now(),
                'end_time' => null,
                'hours' => 0,
            ]);
        }

        return response()->json(['message' => 'Pointage mis à jour avec succès'], 200);
    }
}
