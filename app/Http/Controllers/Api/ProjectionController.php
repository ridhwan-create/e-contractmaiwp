<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectionController extends Controller
{
    public function index()
    {
        return response()->json(Projection::with(['contract', 'budgetCode'])->get(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contract_id' => 'required|exists:contracts,id',
            'budget_code_id' => 'required|exists:budget_codes,id',
            'amount' => 'required|numeric',
            'year' => 'required|integer',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $projection = Projection::create($request->all() + ['created_by' => auth()->id()]);

        return response()->json($projection, 201);
    }

    public function show($id)
    {
        $projection = Projection::with(['contract', 'budgetCode'])->find($id);

        if (!$projection) {
            return response()->json(['message' => 'Projection not found'], 404);
        }

        return response()->json($projection, 200);
    }

    public function update(Request $request, $id)
    {
        $projection = Projection::find($id);
        if (!$projection) {
            return response()->json(['message' => 'Projection not found'], 404);
        }

        $projection->update($request->all() + ['edited_by' => auth()->id()]);

        return response()->json($projection, 200);
    }

    public function destroy($id)
    {
        $projection = Projection::find($id);
        if (!$projection) {
            return response()->json(['message' => 'Projection not found'], 404);
        }

        $projection->delete();

        return response()->json(['message' => 'Projection deleted'], 200);
    }
}
