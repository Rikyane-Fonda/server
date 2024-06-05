<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Http\Requests\StoreOvertimeRequest;
use App\Http\Requests\UpdateOvertimeRequest;

class OvertimeController extends Controller
{
    /**
     * Afficher la liste des heures supplémentaires
     */
    public function index()
    {
        $overtimes = Overtime::all();
        return response()->json($overtimes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Créer une nouvelle heure supplémentaire
     */
    public function store(StoreOvertimeRequest $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'hours' => 'required|numeric',
            'rate' => 'required|numeric',
            'status' => 'required|in:valid,unvalid',
        ]);

        $overtime = Overtime::create($validatedData);
        return response()->json($overtime, 201);
    }

    /**
     * Afficher les détails d'une heure supplémentaire
     */
    public function show($id)
    {
        $overtime = Overtime::findOrFail($id);
        return response()->json($overtime);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Overtime $overtime)
    {
        //
    }

    /**
     * Mettre à jour une heure supplémentaire
     */
    public function update(UpdateOvertimeRequest $request, $id)
    {
        $overtime = Overtime::findOrFail($id);

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'hours' => 'required|numeric',
            'rate' => 'required|numeric',
            'status' => 'required|in:valid,unvalid',
        ]);

        $overtime->update($validatedData);
        return response()->json($overtime);
    }

    /**
     * Supprimer une heure supplémentaire
     */
    public function destroy(Overtime $overtime)
    {
        $overtime = Overtime::findOrFail($id);
        $overtime->delete();
        return response()->json(['message' => 'Overtime deleted successfully']);
    }
}
