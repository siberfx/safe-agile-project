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
        // TODO: Implement store logic
        return redirect()->route('admin.business-goals.index')
            ->with('success', 'Business Goal succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $businessGoal = BusinessGoal::with(['program', 'epics.features.userStories'])->findOrFail($id);
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
        // TODO: Implement update logic
        return redirect()->route('admin.business-goals.index')
            ->with('success', 'Business Goal succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Implement delete logic
        return redirect()->route('admin.business-goals.index')
            ->with('success', 'Business Goal succesvol verwijderd!');
    }
}
