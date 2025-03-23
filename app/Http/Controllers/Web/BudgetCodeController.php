<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetCode;
use Illuminate\Support\Facades\Auth;

class BudgetCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $budgetCode = BudgetCode::orderBy('created_at', 'desc')->paginate($perPage);

        return view('budget_codes.index', compact('budgetCode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('budget_codes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:budget_codes,code',
            'description' => 'required|string|max:255',
        ]);

        BudgetCode::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => Auth::id(),
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('budget_codes.index')->with('success', 'Budget Code berjaya ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BudgetCode $budgetCode)
    {
        return view('budget_codes.view', compact('budgetCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BudgetCode $budgetCode)
    {
        return view('budget_codes.edit', compact('budgetCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BudgetCode $budgetCode)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:budget_codes,code,' . $budgetCode->id,
            'description' => 'required|string|max:255',
        ]);

        $budgetCode->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('budget-codes.index')->with('success', 'Budget Code berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BudgetCode $budgetCode)
    {
        $budgetCode->delete();

        return redirect()->route('budget_codes.index')->with('success', 'Budget Code berjaya dipadam.');
    }
}
