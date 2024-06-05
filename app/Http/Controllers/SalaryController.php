<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;

class SalaryController extends Controller
{
    /**
     * Afficher la liste des salaires
     */
    public function index()
    {
        $salaries = Salary::all();
        return response()->json($salaries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Créer un nouveau salaire
     */
    public function store(StoreSalaryRequest $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'base_salary' => 'required|numeric',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $salary = Salary::create($validatedData);
        return response()->json($salary, 201);
    }

    /**
     * Afficher les détails d'un salaire
     */
    public function show($id)
    {
        $salary = Salary::findOrFail($id);
        return response()->json($salary);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Mettre à jour un salaire
     */
    public function update(UpdateSalaryRequest $request, $id)
    {
        $salary = Salary::findOrFail($id);

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'base_salary' => 'required|numeric',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $salary->update($validatedData);
        return response()->json($salary);
    }

    /**
     * Supprimer un salaire
     */
    public function destroy(Salary $salary)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return response()->json(['message' => 'Salary deleted successfully']);
    }
}
