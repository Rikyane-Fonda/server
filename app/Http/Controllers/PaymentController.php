<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Employee;
use App\Services\PaymentService;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Afficher la liste des paiements
    */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Créer un nouveau paiement.
     */
    public function store(StorePaymentRequest $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount_payable' => 'required|numeric',
            'payment_amount' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid,pending',
            'remains' => 'nullable|numeric',
            'payment_method' => 'required|in:cash,card,cheque,transfer',
        ]);

        $payment = Payment::create($validatedData);


        return response()->json($payment, 201);

    }

    /**
     * Afficher les détails d'un paiement
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Mettre à jour un paiement
     */
    public function update(UpdatePaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount_payable' => 'required|numeric',
            'payment_amount' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid,pending',
            'remains' => 'nullable|numeric',
            'payment_method' => 'required|in:cash,card,cheque,transfer',
        ]);

        $payment->update($validatedData);
        return response()->json($payment);
    }

    /**
     * Supprimer un paiement
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }

    // Méthode pour générer les paiements mensuels
    public function generatePayments()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $this->paymentService->createMonthlyPayment($employee);
        }

        return response()->json(['message' => 'Monthly payments generated successfully']);
    }
}
