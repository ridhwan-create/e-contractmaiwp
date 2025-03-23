<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\ExpenseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::with(['contract', 'expenseCode'])->get(), 200);
    }

    public function create()
    {
        $contracts = Contract::all(); // Ambil semua kontrak
        $expense_codes = ExpenseCode::all(); // Ambil semua kod perbelanjaan
    
        return view('payments.create', compact('contracts', 'expense_codes'));
    }    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contract_id' => 'required|exists:contracts,id',
            'expense_code_id' => 'required|exists:expense_codes,id',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $payment = Payment::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($payment, 201);
    }

    public function show($id)
    {
        $payment = Payment::with(['contract', 'expenseCode'])->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json($payment, 200);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($payment, 200);
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted'], 200);
    }
}
