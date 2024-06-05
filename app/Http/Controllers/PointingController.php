<?php

namespace App\Http\Controllers;

use App\Models\Pointing;
use App\Models\Employee;
use App\Services\PointingService;
use App\Http\Requests\StorePointingRequest;
use App\Http\Requests\UpdatePointingRequest;

class PointingController extends Controller
{
    protected $pointingService;

    public function __construct(PointingService $pointingService)
    {
        $this->pointingService = $pointingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePointingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pointing $pointing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pointing $pointing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePointingRequest $request, Pointing $pointing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pointing $pointing)
    {
        //
    }

    // Méthode pour obtenir le nombre d'heures pointées par mois pour un utilisateur
    public function getMonthlyPointingHours(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $month = $request->input('month');
        $year = $request->input('year');

        $totalHours = $this->pointingService->calculateMonthlyPointingHours($employee, $month, $year);

        return response()->json([
            'user_id' => $userId,
            'month' => $month,
            'year' => $year,
            'total_hours' => $totalHours
        ]);
    }
}
