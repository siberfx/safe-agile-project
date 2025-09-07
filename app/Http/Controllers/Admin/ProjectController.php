<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['program', 'createdBy'])->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        $users = User::all();
        return view('admin.projects.create', compact('programs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'program_id' => 'nullable|exists:programs,id',
            'created_by' => 'required|exists:users,id',
        ]);

        Project::create($request->all());

        return redirect()->route('admin.access.projects.index')
            ->with('success', 'Project successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with(['program', 'createdBy', 'notes.user'])->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $programs = Program::all();
        $users = User::all();
        return view('admin.projects.edit', compact('project', 'programs', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'program_id' => 'nullable|exists:programs,id',
            'created_by' => 'required|exists:users,id',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('admin.access.projects.index')
            ->with('success', 'Project successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.access.projects.index')
            ->with('success', 'Project successfully deleted!');
    }
}
