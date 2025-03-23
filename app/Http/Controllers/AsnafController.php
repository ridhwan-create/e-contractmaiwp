<?php

namespace App\Http\Controllers;

use App\Models\Asnaf;
use Illuminate\Http\Request;

class AsnafController extends Controller
{
    public function index()
    {
        $asnafList = Asnaf::paginate(10);
        return view('asnaf.index', compact('asnafList'));
    }

    public function create()
    {
        return view('asnaf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:asnaf,code|max:50',
            'description' => 'required|max:255',
        ]);

        Asnaf::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('asnaf.index')->with('success', 'Asnaf berjaya ditambah.');
    }

    public function edit(Asnaf $asnaf)
    {
        return view('asnaf.edit', compact('asnaf'));
    }

    public function update(Request $request, Asnaf $asnaf)
    {
        $request->validate([
            'code' => 'required|max:50|unique:asnaf,code,' . $asnaf->id,
            'description' => 'required|max:255',
        ]);

        $asnaf->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => auth()->id(),
        ]);

        return redirect()->route('asnaf.index')->with('success', 'Asnaf berjaya dikemaskini.');
    }

    public function destroy(Asnaf $asnaf)
    {
        $asnaf->delete();
        return redirect()->route('asnaf.index')->with('success', 'Asnaf berjaya dipadam.');
    }
}
