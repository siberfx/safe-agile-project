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
        // TODO: Implement store logic
        return redirect()->route('admin.access.epics.index')
            ->with('success', 'Epic succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $epic = Epic::with(['businessGoal', 'features.userStories'])->findOrFail($id);
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
        // TODO: Implement update logic
        return redirect()->route('admin.access.epics.index')
            ->with('success', 'Epic succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Implement delete logic
        return redirect()->route('admin.access.epics.index')
            ->with('success', 'Epic succesvol verwijderd!');
    }
}
