@extends('layouts.admin')

@section('title', 'Feature Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $feature->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $feature->description }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.features.edit', $feature->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit Feature
            </a>
        </div>
    </div>

    <!-- Feature Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Feature Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="text-sm text-gray-900">
                            @if($feature->status === 'in_progress')
                                In Progress
                            @else
                                {{ ucfirst($feature->status) }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Story Points</label>
                        <p class="text-sm text-gray-900">{{ $feature->story_points ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Program Increment</label>
                        <p class="text-sm text-gray-900">{{ $feature->pi ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Sprint</label>
                        <p class="text-sm text-gray-900">{{ $feature->sprint ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Target Date</label>
                        <p class="text-sm text-gray-900">{{ $feature->target_date ? $feature->target_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Epic -->
            @if($feature->epic)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Epic</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $feature->epic->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($feature->epic->description, 150) }}</p>
                    <a href="{{ route('admin.access.epics.show', $feature->epic->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Epic →
                    </a>
                </div>
            </div>
            @endif

            <!-- User Stories -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">User Stories</h2>
                @if($feature->userStories->count() > 0)
                    <div class="space-y-3">
                        @foreach($feature->userStories as $story)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($story->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        @if($story->story_points)
                                            <span>{{ $story->story_points }} Story Points</span>
                                        @endif
                                        @if($story->sprint)
                                            <span>Sprint: {{ $story->sprint->name }}</span>
                                        @endif
                                        @if($story->assignedTo)
                                            <span>Assigned to: {{ $story->assignedTo->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($story->kanban_status === 'done') bg-green-100 text-green-800
                                    @elseif($story->kanban_status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @elseif($story->kanban_status === 'review') bg-purple-100 text-purple-800
                                    @elseif($story->kanban_status === 'todo') bg-gray-100 text-gray-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $story->kanban_status)) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No user stories defined for this feature.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Notes -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Notes</h2>
                    <button onclick="toggleAddNote()" class="bg-primary text-white px-3 py-1 rounded-lg hover:bg-primary/90 text-sm">
                        <i class="fas fa-plus mr-1"></i>
                        Add New Note
                    </button>
                </div>
                
                <!-- Add Note Form (Hidden by default) -->
                <div id="addNoteForm" class="hidden mb-4">
                    <div class="space-y-3">
                        <textarea 
                            id="noteText"
                            class="w-full px-3 py-2 border border-primary/30 rounded-lg outline-none resize-none" 
                            rows="3" 
                            placeholder="Write your note here..."
                        ></textarea>
                        <div class="flex items-center justify-end space-x-2">
                            <button onclick="cancelAddNote()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                            <button onclick="saveNote()" class="p-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Notes List -->
                <div id="notesList" class="space-y-3">
                    @forelse($feature->notes as $note)
                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-200" data-note-id="{{ $note->id }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">{{ $note->body }}</p>
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <i class="fas fa-user mr-1"></i>
                                    <span>{{ $note->user->name ?? 'Unknown' }}</span>
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>{{ $note->created_at->format('d-m-Y H:i') }}</span>
                                </div>
                            </div>
                            <button onclick="deleteNote(this)" class="ml-2 p-1 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 text-sm py-4">No notes yet. Add your first note!</div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">User Stories</span>
                        <span class="text-sm font-medium text-gray-900">{{ $feature->userStories->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Test Cases</span>
                        <span class="text-sm font-medium text-gray-900">{{ $feature->testCases->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Bugs</span>
                        <span class="text-sm font-medium text-gray-900">{{ $feature->bugs->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.user-stories.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add User Story
                    </a>
                    <a href="{{ route('admin.access.features.edit', $feature->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit Feature
                    </a>
                    <form method="POST" action="{{ route('admin.access.features.destroy', $feature->id) }}" id="deleteFeatureForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDeleteFeature()" class="w-full bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 text-center">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Feature
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDeleteFeature() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this! This will permanently delete the feature and all associated data.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete the feature.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById('deleteFeatureForm').submit();
        }
    });
}

// Notes functionality
window.toggleAddNote = function() {
    const form = document.getElementById('addNoteForm');
    const textarea = document.getElementById('noteText');
    
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        textarea.focus();
    } else {
        form.classList.add('hidden');
        textarea.value = '';
    }
}

window.cancelAddNote = function() {
    const form = document.getElementById('addNoteForm');
    const textarea = document.getElementById('noteText');
    
    form.classList.add('hidden');
    textarea.value = '';
}

window.saveNote = function() {
    const textarea = document.getElementById('noteText');
    const noteText = textarea.value.trim();
    
    if (!noteText) {
        Swal.fire({
            title: 'Empty Note',
            text: 'Please write something before saving.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    // Show loading
    Swal.fire({
        title: 'Saving...',
        text: 'Please wait while we save your note.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Save note via API
    fetch('/admin/api/notes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            entity_type: 'App\\Models\\Feature',
            entity_id: {{ $feature->id }},
            body: noteText
        })
    })
    .then(response => response.json())
    .then(response => {
        Swal.close();
        
        // Add note to the list
        addNoteToList(response.data);
        
        // Clear form and hide
        textarea.value = '';
        document.getElementById('addNoteForm').classList.add('hidden');
        
        // Show success message
        Swal.fire({
            title: 'Note Added!',
            text: 'Your note has been saved successfully.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    })
    .catch(error => {
        console.error('Error saving note:', error);
        Swal.fire({
            title: 'Error',
            text: 'Failed to save note. Please try again.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}

window.addNoteToList = function(noteData) {
    const notesList = document.getElementById('notesList');
    const emptyState = notesList.querySelector('.text-center');
    
    // Remove empty state if it exists
    if (emptyState) {
        emptyState.remove();
    }
    
    // Create note element
    const noteElement = document.createElement('div');
    noteElement.className = 'bg-gray-50 rounded-lg p-4 border border-gray-200';
    noteElement.setAttribute('data-note-id', noteData.id);
    noteElement.innerHTML = `
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-sm text-gray-900 mb-2">${noteData.body}</p>
                <div class="flex items-center text-xs text-gray-500">
                    <i class="fas fa-user mr-1"></i>
                    <span>${noteData.user_name}</span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-1"></i>
                    <span>${noteData.created_at}</span>
                </div>
            </div>
            <button onclick="deleteNote(this)" class="p-1 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors">
                <i class="fas fa-trash text-xs"></i>
            </button>
        </div>
    `;
    
    // Add to top of list
    notesList.insertBefore(noteElement, notesList.firstChild);
}

window.deleteNote = function(button) {
    const noteElement = button.closest('.bg-gray-50');
    const noteId = noteElement.getAttribute('data-note-id');
    
    Swal.fire({
        title: 'Delete Note?',
        text: "This note will be permanently deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete the note.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Delete note via API
            fetch(`/admin/api/notes/${noteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                
                // Remove note element
                noteElement.remove();
                
                // Show empty state if no notes left
                const notesList = document.getElementById('notesList');
                if (notesList.children.length === 0) {
                    notesList.innerHTML = `
                        <div class="text-center text-gray-500 text-sm py-4">
                            No notes yet. Add your first note!
                        </div>
                    `;
                }
                
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Note has been deleted.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            })
            .catch(error => {
                console.error('Error deleting note:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to delete note. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}
</script>
@endsection
