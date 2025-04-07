<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllocationController extends Controller
{
    public function index()
    {
        $allocations = Allocation::orderBy('year', 'desc')->paginate(10);
        return view('allocations.index', compact('allocations'));
    }    

    public function create()
    {
        return view('allocations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|digits:4|integer',
            'total_allocation' => 'required|numeric',
        ]);

        Allocation::create([
            'year' => $request->year,
            'total_allocation' => $request->total_allocation,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('allocations.index')->with('success', 'Allocation created successfully.');
    }

    public function edit(Allocation $allocation)
    {
        return view('allocations.edit', compact('allocation'));
    }

    public function update(Request $request, Allocation $allocation)
    {
        $request->validate([
            'year' => 'required|digits:4|integer',
            'total_allocation' => 'required|numeric',
        ]);

        $allocation->update([
            'year' => $request->year,
            'total_allocation' => $request->total_allocation,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('allocations.index')->with('success', 'Allocation updated successfully.');
    }

    public function destroy(Allocation $allocation)
    {
        $allocation->delete();
        return redirect()->route('allocations.index')->with('success', 'Allocation deleted successfully.');
    }
}
