<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Kanban API Routes - Laravel 12 Standards
Route::middleware(['web', 'auth', 'role:admin|super_admin'])->group(function () {
    // Resource routes for tasks
    Route::apiResource('tasks', TaskController::class);
    
    // Additional Kanban-specific routes
    Route::get('tasks/stats/kanban', [TaskController::class, 'stats'])->name('tasks.stats');
    
    // Users endpoint for assignee selection
    Route::get('users', function() {
        return response()->json([
            'data' => \App\Models\User::select('id', 'name', 'email')->get(),
            'message' => 'Users retrieved successfully'
        ]);
    });
});