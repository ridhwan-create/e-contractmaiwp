<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company; // Tukar model mengikut keperluan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::all(), 200);
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

        $company = Company::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($company, 201);
    }

    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        return response()->json($company, 200);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $company->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($company, 200);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Expense Code not found'], 404);
        }

        $company->delete();

        return response()->json(['message' => 'Expense Code deleted'], 200);
    }
}
