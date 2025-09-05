<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bug;
use App\Models\Feature;
use App\Models\Sprint;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bugs = Bug::with(['feature', 'sprint', 'reporter', 'assignee'])->get();
        return view('admin.bugs.index', compact('bugs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = Feature::all();
        $sprints = Sprint::all();
        $userStories = Task::all();
        $users = User::all();
        return view('admin.bugs.create', compact('features', 'sprints', 'userStories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement store logic
        return redirect()->route('admin.access.bugs.index')
            ->with('success', 'Bug succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bug = Bug::with(['feature', 'sprint', 'reporter', 'assignee'])->findOrFail($id);
        return view('admin.bugs.show', compact('bug'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bug = Bug::findOrFail($id);
        $features = Feature::all();
        $sprints = Sprint::all();
        $userStories = Task::all();
        $users = User::all();
        return view('admin.bugs.edit', compact('bug', 'features', 'sprints', 'userStories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: Implement update logic
        return redirect()->route('admin.access.bugs.index')
            ->with('success', 'Bug succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Implement delete logic
        return redirect()->route('admin.access.bugs.index')
            ->with('success', 'Bug succesvol verwijderd!');
    }
}
