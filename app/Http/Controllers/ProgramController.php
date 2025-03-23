<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller {
    public function index() {
        $programs = Program::paginate(10);
        return view('programs.index', compact('programs'));
    }

    public function create() {
        return view('programs.create');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required|unique:programs,code|max:255',
            'description' => 'required|max:255',
        ]);

        Program::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('programs.index')->with('success', 'Program berjaya ditambah!');
    }

    public function edit(Program $program) {
        return view('programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program) {
        $request->validate([
            'code' => 'required|max:255|unique:programs,code,' . $program->id,
            'description' => 'required|max:255',
        ]);

        $program->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => auth()->id(),
        ]);

        return redirect()->route('programs.index')->with('success', 'Program berjaya dikemaskini!');
    }

    public function destroy(Program $program) {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program berjaya dihapuskan!');
    }
}
