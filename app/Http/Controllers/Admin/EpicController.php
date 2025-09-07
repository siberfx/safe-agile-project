<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Epic;
use App\Models\BusinessGoal;
use Illuminate\Http\Request;

class EpicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $epics = Epic::with(['businessGoal', 'features'])->get();
        return view('admin.epics.index', compact('epics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businessGoals = BusinessGoal::all();
        return view('admin.epics.create', compact('businessGoals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'business_goal_id' => 'required|exists:business_goals,id',
            'priority' => 'required|in:low,medium,high,critical',
            'expected_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,in_progress,completed,cancelled',
            'story_points' => 'nullable|integer|min:0|max:1000',
            'target_date' => 'nullable|date|after:today',
        ]);

        Epic::create($request->all());

        return redirect()->route('admin.access.epics.index')
            ->with('success', 'Epic created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $epic = Epic::with(['businessGoal', 'features.userStories', 'notes.user'])->findOrFail($id);
        return view('admin.epics.show', compact('epic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $epic = Epic::findOrFail($id);
        $businessGoals = BusinessGoal::all();
        return view('admin.epics.edit', compact('epic', 'businessGoals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $epic = Epic::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'business_goal_id' => 'required|exists:business_goals,id',
            'priority' => 'required|in:low,medium,high,critical',
            'expected_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,in_progress,completed,cancelled',
            'story_points' => 'nullable|integer|min:0|max:1000',
            'target_date' => 'nullable|date',
        ]);

        $epic->update($request->all());

        return redirect()->route('admin.access.epics.index')
            ->with('success', 'Epic updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $epic = Epic::findOrFail($id);
        $epic->delete();

        return redirect()->route('admin.access.epics.index')
            ->with('success', 'Epic deleted successfully!');
    }
}
