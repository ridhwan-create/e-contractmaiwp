<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller {
    public function index() {
        $departments = Department::latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }

    public function create() {
        return view('departments.create');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required|unique:departments,code',
            'description' => 'required',
        ]);

        Department::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('departments.index')->with('success', 'Bahagian berjaya ditambah!');
    }

    public function edit(Department $department) {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department) {
        $request->validate([
            'code' => 'required|unique:departments,code,' . $department->id,
            'description' => 'required',
        ]);

        $department->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('departments.index')->with('success', 'Bahagian berjaya dikemaskini!');
    }

    public function destroy(Department $department) {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Bahagian berjaya dihapuskan!');
    }
}
