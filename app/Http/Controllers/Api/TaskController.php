<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = Task::with(['assignedTo', 'project', 'sprint'])
            ->orderBy('kanban_order')
            ->get()
            ->map(function ($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => $task->kanban_status,
                    'priority' => $task->priority,
                    'story_points' => $task->story_points,
                    'assignee' => $task->assignedTo?->name,
                    'assignee_id' => $task->assigned_to,
                    'project' => $task->project?->name,
                    'sprint' => $task->sprint?->name,
                    'tags' => $task->tags ?? [],
                    'notes' => $task->notes,
                    'due_date' => $task->due_date?->format('Y-m-d'),
                    'started_at' => $task->started_at?->format('Y-m-d H:i:s'),
                    'completed_at' => $task->completed_at?->format('Y-m-d H:i:s'),
                    'created_at' => $task->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json([
            'data' => $tasks,
            'message' => 'Tasks retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'kanban_status' => 'required|in:todo,in_progress,review,done',
                'priority' => 'required|in:low,medium,high',
                'story_points' => 'nullable|integer|min:0',
                'assigned_to' => 'nullable|exists:users,id',
                'project_id' => 'nullable|exists:projects,id',
                'sprint_id' => 'nullable|exists:sprints,id',
                'tags' => 'nullable|array',
                'notes' => 'nullable|string',
                'due_date' => 'nullable|date',
            ]);

            $task = Task::create([
                ...$validated,
                'kanban_order' => Task::where('kanban_status', $validated['kanban_status'])->max('kanban_order') + 1,
            ]);

            $task->load(['assignedTo', 'project', 'sprint']);

            return response()->json([
                'data' => $this->formatTask($task),
                'message' => 'Task created successfully'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        $task->load(['assignedTo', 'project', 'sprint']);

        return response()->json([
            'data' => $this->formatTask($task),
            'message' => 'Task retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string|nullable',
                'kanban_status' => 'sometimes|in:todo,in_progress,review,done',
                'priority' => 'sometimes|in:low,medium,high',
                'story_points' => 'sometimes|integer|min:0|nullable',
                'assigned_to' => 'sometimes|exists:users,id|nullable',
                'project_id' => 'sometimes|exists:projects,id|nullable',
                'sprint_id' => 'sometimes|exists:sprints,id|nullable',
                'tags' => 'sometimes|array|nullable',
                'notes' => 'sometimes|string|nullable',
                'due_date' => 'sometimes|date|nullable',
                'kanban_order' => 'sometimes|integer|min:0',
            ]);

            DB::transaction(function () use ($validated, $task) {
                $oldStatus = $task->kanban_status;
                $newStatus = $validated['kanban_status'] ?? $oldStatus;

                $task->update($validated);

                // Update timestamps based on status change
                if ($oldStatus !== $newStatus) {
                    if ($newStatus === 'in_progress' && !$task->started_at) {
                        $task->update(['started_at' => now()]);
                    } elseif ($newStatus === 'done' && !$task->completed_at) {
                        $task->update(['completed_at' => now()]);
                    }
                }
            });

            $task->load(['assignedTo', 'project', 'sprint']);

            return response()->json([
                'data' => $this->formatTask($task),
                'message' => 'Task updated successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }

    /**
     * Get task statistics for Kanban board
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total' => Task::count(),
            'todo' => Task::where('kanban_status', 'todo')->count(),
            'in_progress' => Task::where('kanban_status', 'in_progress')->count(),
            'review' => Task::where('kanban_status', 'review')->count(),
            'done' => Task::where('kanban_status', 'done')->count(),
            'completed_this_week' => Task::where('kanban_status', 'done')
                ->where('completed_at', '>=', now()->startOfWeek())
                ->count(),
        ];

        return response()->json([
            'data' => $stats,
            'message' => 'Statistics retrieved successfully'
        ]);
    }

    /**
     * Format task data for API response
     */
    private function formatTask(Task $task): array
    {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->kanban_status,
            'priority' => $task->priority,
            'story_points' => $task->story_points,
            'assignee' => $task->assignedTo?->name,
            'assignee_id' => $task->assigned_to,
            'project' => $task->project?->name,
            'sprint' => $task->sprint?->name,
            'tags' => $task->tags ?? [],
            'notes' => $task->notes,
            'due_date' => $task->due_date?->format('Y-m-d'),
            'started_at' => $task->started_at?->format('Y-m-d H:i:s'),
            'completed_at' => $task->completed_at?->format('Y-m-d H:i:s'),
            'created_at' => $task->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $task->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}