<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Afficher la liste des employés
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Créer un nouvel employé
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'national_ID_card' => 'nullable|string|max:255',
            'adress' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'Telephone' => 'nullable|string|max:255',
            'hiring_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $employee = Employee::create($validatedData);
        return response()->json($employee, 201);
    }

    /**
     * Afficher les détails d'un employé
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Mettre à jour un employé.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'national_ID_card' => 'nullable|string|max:255',
            'adress' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'Telephone' => 'nullable|string|max:255',
            'hiring_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|in:active,inactive',
        ]);

        $employee->update($validatedData);
        return response()->json($employee);
    }

    /**
     * Supprimer un employé
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }

    // Changer le statut d'un employé et enregistrer la date de départ
    public function changeStatus(Request $request, $id)
    {
        // 1. Récupérer l'employé par ID
        $employee = Employee::findOrFail($id);

        // 2. Valider les données d'entrée
        $validatedData = $request->validate([
            'status' => 'required|in:active,inactive',
            'departure_date' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        // 3. Vérifier la logique métier : si status est 'inactive', departure_date est obligatoire
        if ($validatedData['status'] === 'inactive' && !$validatedData['departure_date']) {
            return response()->json(['error' => 'Departure date is required when status is inactive'], 400);
        }

        // 4. Mettre à jour les attributs de l'employé
        $employee->status = $validatedData['status'];
        $employee->departure_date = $validatedData['departure_date'] ?? null;
        $employee->save(); // Sauvegarder les modifications

        // 5. Retourner l'employé mis à jour en réponse JSON
        return response()->json($employee);
    }
}
