<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractTypeController extends Controller
{
    public function index()
    {
        $contractTypes = ContractType::paginate(10);
        return view('contract_types.index', compact('contractTypes'));
    }

    public function create()
    {
        return view('contract_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:contract_types,name',
            'description' => 'nullable|string|max:1000',
        ]);

        ContractType::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('contract-types.index')->with('success', 'Jenis Kontrak berjaya ditambah.');
    }

    public function edit(ContractType $contractType)
    {
        return view('contract_types.edit', compact('contractType'));
    }

    public function update(Request $request, ContractType $contractType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:contract_types,name,' . $contractType->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $contractType->update([
            'name' => $request->name,
            'description' => $request->description,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('contract-types.index')->with('success', 'Jenis Kontrak berjaya dikemaskini.');
    }

    public function destroy(ContractType $contractType)
    {
        $contractType->delete();
        return redirect()->route('contract-types.index')->with('success', 'Jenis Kontrak berjaya dihapuskan.');
    }
}
