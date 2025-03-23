<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCode;
use Illuminate\Http\Request;

class ExpenseCodeController extends Controller
{
    public function index()
    {
        $expenseCodes = ExpenseCode::latest()->paginate(10);
        return view('expense_codes.index', compact('expenseCodes'));
    }

    public function show($id)
    {
        $expenseCode = ExpenseCode::findOrFail($id);
        return view('expense_codes.view', compact('expenseCode'));
    }

    public function create()
    {
        return view('expense_codes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['code' => 'required|unique:expense_codes', 'description' => 'required']);

        ExpenseCode::create($request->all() + ['created_by' => auth()->id()]);
        return redirect()->route('expense-codes.index')->with('success', 'Kod Bayaran berjaya ditambah!');
    }

    public function edit(ExpenseCode $expenseCode)
    {
        return view('expense_codes.edit', compact('expenseCode'));
    }

    // public function update(Request $request, ExpenseCode $expenseCode)
    // {
    //     $request->validate(['code' => 'required|unique:expense_codes,code,' . $expenseCode->id, 'description' => 'required']);

    //     $expenseCode->update($request->all() + ['edited_by' => auth()->id()]);
    //     return redirect()->route('expense-codes.index')->with('success', 'Kod Bayaran berjaya dikemas kini!');
    // }

    public function update(Request $request, ExpenseCode $expenseCode)
    {
        $request->validate(['code' => 'required|unique:expense_codes,code,' . $expenseCode->id, 'description' => 'required']);

        $expenseCode->update($request->all() + ['edited_by' => auth()->id()]);

        return redirect()->route('expense-codes.index')->with('success', 'Kod Bayaran berjaya dikemas kini!');
    }
    

    public function destroy(ExpenseCode $expenseCode)
    {
        $expenseCode->delete();
        return redirect()->route('expense-codes.index')->with('success', 'Kod Bayaran berjaya dihapuskan!');
    }
}
