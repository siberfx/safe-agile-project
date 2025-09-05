<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Feature;
use App\Models\Sprint;
use App\Models\User;
use Illuminate\Http\Request;

class UserStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStories = Task::with(['feature', 'sprint', 'assignedTo'])->get();
        return view('admin.user-stories.index', compact('userStories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = Feature::all();
        $sprints = Sprint::all();
        $users = User::all();
        return view('admin.user-stories.create', compact('features', 'sprints', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement store logic
        return redirect()->route('admin.access.user-stories.index')
            ->with('success', 'User Story succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userStory = Task::with(['feature', 'sprint', 'assignedTo'])->findOrFail($id);
        return view('admin.user-stories.show', compact('userStory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userStory = Task::findOrFail($id);
        $features = Feature::all();
        $sprints = Sprint::all();
        $users = User::all();
        return view('admin.user-stories.edit', compact('userStory', 'features', 'sprints', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: Implement update logic
        return redirect()->route('admin.access.user-stories.index')
            ->with('success', 'User Story succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Implement delete logic
        return redirect()->route('admin.access.user-stories.index')
            ->with('success', 'User Story succesvol verwijderd!');
    }
}
