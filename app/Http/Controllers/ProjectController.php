<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:projects,code|max:10',
            'description' => 'required',
        ]);

        Project::create([
            'code' => $request->code,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projek berjaya ditambah!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'code' => 'required|max:10|unique:projects,code,' . $project->id,
            'description' => 'required',
        ]);

        $project->update([
            'code' => $request->code,
            'description' => $request->description,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projek berjaya dikemaskini!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projek berjaya dihapuskan!');
    }
}
