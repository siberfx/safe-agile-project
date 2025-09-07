<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Epic;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::with(['epic', 'userStories'])->get();
        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $epics = Epic::all();
        return view('admin.features.create', compact('epics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'epic_id' => 'required|exists:epics,id',
            'pi' => 'nullable|string|max:255',
            'sprint' => 'nullable|string|max:255',
            'status' => 'required|in:draft,in_progress,completed,cancelled',
            'story_points' => 'nullable|integer|min:0|max:1000',
            'target_date' => 'nullable|date|after:today',
        ]);

        Feature::create($request->all());

        return redirect()->route('admin.access.features.index')
            ->with('success', 'Feature created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feature = Feature::with(['epic', 'userStories', 'notes.user'])->findOrFail($id);
        return view('admin.features.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature = Feature::findOrFail($id);
        $epics = Epic::all();
        return view('admin.features.edit', compact('feature', 'epics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature = Feature::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'epic_id' => 'required|exists:epics,id',
            'pi' => 'nullable|string|max:255',
            'sprint' => 'nullable|string|max:255',
            'status' => 'required|in:draft,in_progress,completed,cancelled',
            'story_points' => 'nullable|integer|min:0|max:1000',
            'target_date' => 'nullable|date|after:today',
        ]);

        $feature->update($request->all());

        return redirect()->route('admin.access.features.index')
            ->with('success', 'Feature updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.access.features.index')
            ->with('success', 'Feature deleted successfully!');
    }
}
