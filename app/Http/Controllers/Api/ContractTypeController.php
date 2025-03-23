<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContractType; // Tukar model mengikut keperluan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractTypeController extends Controller
{
    public function index()
    {
        return response()->json(ContractType::all(), 200);
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

        $contractType = ContractType::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($contractType, 201);
    }

    public function show($id)
    {
        $contractType = ContractType::find($id);

        if (!$contractType) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        return response()->json($contractType, 200);
    }

    public function update(Request $request, $id)
    {
        $contractType = ContractType::find($id);
        if (!$contractType) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $contractType->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($contractType, 200);
    }

    public function destroy($id)
    {
        $contractType = ContractType::find($id);
        if (!$contractType) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $contractType->delete();

        return response()->json(['message' => 'Expense Code deleted'], 200);
    }
}
