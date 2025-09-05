<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestCase;
use App\Models\Feature;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testCases = TestCase::with(['feature', 'userStory', 'tester'])->get();
        return view('admin.testing.index', compact('testCases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = Feature::all();
        $userStories = Task::all();
        $users = User::all();
        return view('admin.testing.create', compact('features', 'userStories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement store logic
        return redirect()->route('admin.access.testing.index')
            ->with('success', 'Test Case succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testCase = TestCase::with(['feature', 'userStory', 'tester'])->findOrFail($id);
        return view('admin.testing.show', compact('testCase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testCase = TestCase::findOrFail($id);
        $features = Feature::all();
        $userStories = Task::all();
        $users = User::all();
        return view('admin.testing.edit', compact('testCase', 'features', 'userStories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: Implement update logic
        return redirect()->route('admin.access.testing.index')
            ->with('success', 'Test Case succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Implement delete logic
        return redirect()->route('admin.access.testing.index')
            ->with('success', 'Test Case succesvol verwijderd!');
    }
}
