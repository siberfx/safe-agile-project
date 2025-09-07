<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessGoal;
use App\Models\Program;
use Illuminate\Http\Request;

class BusinessGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessGoals = BusinessGoal::with(['program', 'epics'])->get();
        return view('admin.business-goals.index', compact('businessGoals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('admin.business-goals.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'value_score' => 'nullable|integer|min:1|max:100',
            'quarter' => 'nullable|string|in:Q1,Q2,Q3,Q4',
            'year' => 'nullable|integer|min:2020|max:2030',
            'status' => 'required|in:draft,in_progress,completed,cancelled',
            'program_id' => 'required|exists:programs,id',
            'target_date' => 'nullable|date|after:today',
            'budget' => 'nullable|numeric|min:0',
            'prognose' => 'nullable|numeric|min:0',
        ]);

        BusinessGoal::create($request->all());

        return redirect()->route('admin.access.business-goals.index')
            ->with('success', 'Business Goal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $businessGoal = BusinessGoal::with(['program', 'epics.features.userStories', 'notes.user'])->findOrFail($id);
        return view('admin.business-goals.show', compact('businessGoal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $businessGoal = BusinessGoal::findOrFail($id);
        $programs = Program::all();
        return view('admin.business-goals.edit', compact('businessGoal', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $businessGoal = BusinessGoal::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'value_score' => 'nullable|integer|min:1|max:100',
            'quarter' => 'nullable|string|in:Q1,Q2,Q3,Q4',
            'year' => 'nullable|integer|min:2020|max:2030',
            'status' => 'required|in:draft,in_progress,completed,cancelled',
            'program_id' => 'required|exists:programs,id',
            'target_date' => 'nullable|date',
            'budget' => 'nullable|numeric|min:0',
            'prognose' => 'nullable|numeric|min:0',
        ]);

        $businessGoal->update($request->all());

        return redirect()->route('admin.access.business-goals.index')
            ->with('success', 'Business Goal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $businessGoal = BusinessGoal::findOrFail($id);
        $businessGoal->delete();

        return redirect()->route('admin.access.business-goals.index')
            ->with('success', 'Business Goal deleted successfully!');
    }
}
