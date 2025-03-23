<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCode; // Tukar model mengikut keperluan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseCodeController extends Controller
{
    public function index()
    {
        return response()->json(ExpenseCode::all(), 200);
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

        $expenseCode = ExpenseCode::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($expenseCode, 201);
    }

    public function show($id)
    {
        $expenseCode = ExpenseCode::find($id);

        if (!$expenseCode) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        return response()->json($expenseCode, 200);
    }

    public function update(Request $request, $id)
    {
        $expenseCode = ExpenseCode::find($id);
        if (!$expenseCode) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $expenseCode->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($expenseCode, 200);
    }

    public function destroy($id)
    {
        $expenseCode = ExpenseCode::find($id);
        if (!$expenseCode) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $expenseCode->delete();

        return response()->json(['message' => 'Expense Code deleted'], 200);
    }
}
