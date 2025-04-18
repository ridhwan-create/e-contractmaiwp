<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BudgetCode; // Tukar model mengikut keperluan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BudgetCodeController extends Controller
{
    public function index()
    {
        return response()->json(BudgetCode::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:expense_codes',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $budgetCode = BudgetCode::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($budgetCode, 201);
    }

    public function show($id)
    {
        $budgetCode = BudgetCode::find($id);

        if (!$budgetCode) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        return response()->json($budgetCode, 200);
    }

    public function update(Request $request, $id)
    {
        $budgetCode = BudgetCode::find($id);
        if (!$budgetCode) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $budgetCode->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($budgetCode, 200);
    }

    public function destroy($id)
    {
        $budgetCode = BudgetCode::find($id);
        if (!$budgetCode) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $budgetCode->delete();

        return response()->json(['message' => 'Expense Code deleted'], 200);
    }
}
