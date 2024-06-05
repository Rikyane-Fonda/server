<?php

namespace App\Http\Controllers;

use App\Models\Remuneration;
use App\Http\Requests\StoreRemunerationRequest;
use App\Http\Requests\UpdateRemunerationRequest;

class RemunerationController extends Controller
{
    /**
     * Afficher la liste des rémunérations
     */
    public function index()
    {
        $remunerations = Remuneration::all();
        return response()->json($remunerations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Créer une nouvelle rémunération
     */
    public function store(StoreRemunerationRequest $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'bonus' => 'nullable|numeric',
            'prime' => 'nullable|numeric',
            'motif_prime' => 'nullable|string',
            'deduction' => 'nullable|numeric',
            'motif_deduction' => 'nullable|string',
        ]);

        // Calculer le montant total de la rémunération
        $validatedData['amount'] = ($validatedData['bonus'] ?? 0) + ($validatedData['prime'] ?? 0) - ($validatedData['deduction'] ?? 0);

        $remuneration = Remuneration::create($validatedData);
        return response()->json($remuneration, 201);
    }

    /**
     * Afficher les détails d'une rémunération
     */
    public function show($id)
    {
        $remuneration = Remuneration::findOrFail($id);
        return response()->json($remuneration);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remuneration $remuneration)
    {
        //
    }

    /**
     * Mettre à jour une rémunération
     */
    public function update(UpdateRemunerationRequest $request, Remuneration $id)
    {
        $remuneration = Remuneration::findOrFail($id);

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'bonus' => 'nullable|numeric',
            'prime' => 'nullable|numeric',
            'motif_prime' => 'nullable|string',
            'deduction' => 'nullable|numeric',
            'motif_deduction' => 'nullable|string',
        ]);

        // Calculer le montant total de la rémunération
        $validatedData['amount'] = ($validatedData['bonus'] ?? 0) + ($validatedData['prime'] ?? 0) - ($validatedData['deduction'] ?? 0);

        $remuneration->update($validatedData);
        return response()->json($remuneration);
    }

    /**
     * Supprimer une rémunération
     */
    public function destroy($id)
    {
        $remuneration = Remuneration::findOrFail($id);
        $remuneration->delete();
        return response()->json(['message' => 'Remuneration deleted successfully']);
    }
}
