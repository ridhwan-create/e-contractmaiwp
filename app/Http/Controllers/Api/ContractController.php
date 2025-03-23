<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{
    public function index()
    {
        return response()->json(Contract::with(['company', 'contractType', 'budgetCode'])->get(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contract_number' => 'required|unique:contracts',
            'title' => 'required',
            'company_id' => 'required|exists:companies,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'budget_code_id' => 'required|exists:budget_codes,id',
            'contract_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $contract = Contract::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($contract, 201);
    }

    // public function show($id)
    // {
    //     $contract = Contract::with(['company', 'contractType', 'budgetCode'])->find($id);

    //     if (!$contract) {
    //         return response()->json(['message' => 'Contract not found'], 404);
    //     }

    //     return response()->json($contract, 200);
    // }

    // public function show($id)
    // {
    //     $contract = Contract::with(['company', 'contractType', 'budgetCode', 'projections'])->findOrFail($id);
    //     return view('contracts.show', compact('contract'));
    // }

    public function show($id)
    {
        $contract = Contract::with('projections.budgetCode')->findOrFail($id);
        return view('contracts.view', compact('contract'));
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::find($id);
        if (!$contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'contract_number' => 'required|unique:contracts,contract_number,' . $id,
            'title' => 'required',
            'company_id' => 'required|exists:companies,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'budget_code_id' => 'required|exists:budget_codes,id',
            'contract_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $contract->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($contract, 200);
    }

    public function destroy($id)
    {
        $contract = Contract::find($id);
        if (!$contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        $contract->delete();

        return response()->json(['message' => 'Contract deleted'], 200);
    }
}
