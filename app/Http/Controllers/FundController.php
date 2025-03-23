<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller {
    public function index() {
        $funds = Fund::paginate(10);
        return view('funds.index', compact('funds'));
    }

    public function create() {
        return view('funds.create');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required|unique:funds,code',
            'description' => 'required',
        ]);

        Fund::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('funds.index')->with('success', 'Dana berjaya ditambah!');
    }

    public function edit(Fund $fund) {
        return view('funds.edit', compact('fund'));
    }

    public function update(Request $request, Fund $fund) {
        $request->validate([
            'code' => 'required|unique:funds,code,' . $fund->id,
            'description' => 'required',
        ]);

        $fund->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => auth()->id(),
        ]);

        return redirect()->route('funds.index')->with('success', 'Dana berjaya dikemaskini!');
    }

    public function destroy(Fund $fund) {
        $fund->delete();
        return redirect()->route('funds.index')->with('success', 'Dana berjaya dihapuskan!');
    }
}
