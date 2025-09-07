<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    /**
     * Store a newly created note.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'entity_type' => 'required|string',
            'entity_id' => 'required|integer',
            'body' => 'required|string|max:1000',
        ]);

        $note = Note::create([
            'entity_type' => $request->entity_type,
            'entity_id' => $request->entity_id,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        // Load the user relationship
        $note->load('user');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $note->id,
                'body' => $note->body,
                'user_name' => $note->user->name ?? 'Unknown',
                'created_at' => $note->created_at->format('d-m-Y H:i'),
            ],
            'message' => 'Note created successfully'
        ]);
    }

    /**
     * Remove the specified note.
     */
    public function destroy(Note $note): JsonResponse
    {
        // Check if user can delete this note (owner or admin)
        if ($note->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete this note'
            ], 403);
        }

        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note deleted successfully'
        ]);
    }
}