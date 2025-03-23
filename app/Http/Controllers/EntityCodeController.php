<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntityCode;

class EntityCodeController extends Controller
{
    public function index()
    {
        $entityCodes = EntityCode::latest()->paginate(10);
        return view('entity_codes.index', compact('entityCodes'));
    }

    public function create()
    {
        return view('entity_codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:entity_codes,code|max:255',
            'description' => 'required|string|max:255',
        ]);

        EntityCode::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('entity_codes.index')->with('success', 'Kod Entiti berjaya ditambah!');
    }

    public function edit(EntityCode $entityCode)
    {
        return view('entity_codes.edit', compact('entityCode'));
    }

    public function update(Request $request, EntityCode $entityCode)
    {
        $request->validate([
            'code' => 'required|max:255|unique:entity_codes,code,' . $entityCode->id,
            'description' => 'required|string|max:255',
        ]);

        $entityCode->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => auth()->id(),
        ]);

        return redirect()->route('entity-codes.index')->with('success', 'Kod Entiti berjaya dikemaskini!');
    }

    public function destroy(EntityCode $entityCode)
    {
        $entityCode->delete();
        return redirect()->route('entity-codes.index')->with('success', 'Kod Entiti berjaya dipadam!');
    }
}
