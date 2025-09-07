<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class KanbanController extends Controller
{
    /**
     * Get all tasks for Kanban board
     */
    public function getTasks(): JsonResponse
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

        return response()->json($tasks);
    }

    /**
     * Update task status and order
     */
    public function updateTask(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:todo,in_progress,review,done',
            'order' => 'sometimes|integer|min:0',
            'notes' => 'sometimes|string|nullable',
        ]);

        DB::transaction(function () use ($request, $task) {
            $oldStatus = $task->kanban_status;
            $newStatus = $request->status;

            // Update task
            $task->update([
                'kanban_status' => $newStatus,
                'kanban_order' => $request->order ?? $task->kanban_order,
                'notes' => $request->notes ?? $task->notes,
            ]);

            // Update timestamps based on status change
            if ($oldStatus !== $newStatus) {
                if ($newStatus === 'in_progress' && !$task->started_at) {
                    $task->update(['started_at' => now()]);
                } elseif ($newStatus === 'done' && !$task->completed_at) {
                    $task->update(['completed_at' => now()]);
                }
            }
        });

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $this->getTaskData($task)
        ]);
    }

    /**
     * Create a new task
     */
    public function createTask(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,review,done',
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
            'title' => $request->title,
            'description' => $request->description,
            'kanban_status' => $request->status,
            'priority' => $request->priority,
            'story_points' => $request->story_points,
            'assigned_to' => $request->assigned_to,
            'project_id' => $request->project_id,
            'sprint_id' => $request->sprint_id,
            'tags' => $request->tags,
            'notes' => $request->notes,
            'due_date' => $request->due_date,
            'kanban_order' => Task::where('kanban_status', $request->status)->max('kanban_order') + 1,
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $this->getTaskData($task)
        ], 201);
    }

    /**
     * Delete a task
     */
    public function deleteTask(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }

    /**
     * Get task statistics
     */
    public function getStats(): JsonResponse
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

        return response()->json($stats);
    }

    /**
     * Helper method to get task data
     */
    private function getTaskData(Task $task): array
    {
        $task->load(['assignedTo', 'project', 'sprint']);
        
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
    }
}