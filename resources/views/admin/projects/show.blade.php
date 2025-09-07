@extends('layouts.admin')

@section('title', 'Project Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $project->name }}</h1>
            <p class="text-gray-600 mt-2">Project details and management</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.projects.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Projects
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Project Overview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Project Overview</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <p class="text-gray-900">{{ $project->description ?: 'No description provided' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full
                                    @if($project->status === 'active') bg-green-100 text-green-800
                                    @elseif($project->status === 'completed') bg-blue-100 text-blue-800
                                    @elseif($project->status === 'inactive') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Created By</label>
                                <p class="text-gray-900">{{ $project->createdBy->name ?? 'Unknown' }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                                <p class="text-gray-900">{{ $project->start_date ? $project->start_date->format('d-m-Y') : 'Not set' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                                <p class="text-gray-900">{{ $project->end_date ? $project->end_date->format('d-m-Y') : 'Not set' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Program Information -->
            @if($project->program)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Program Information</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $project->program->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->program->description, 150) }}</p>
                        </div>
                        <a href="{{ route('admin.access.programs.show', $project->program->id) }}" class="text-primary hover:text-primary/80">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Project Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Project Information</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Created:</span>
                        <span class="text-gray-900">{{ $project->created_at->format('d-m-Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="text-gray-900">{{ $project->updated_at->format('d-m-Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Program:</span>
                        <span class="text-gray-900">{{ $project->program->name ?? 'Independent' }}</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Notes</h2>
                    <button onclick="toggleAddNote()" class="bg-primary text-white px-3 py-1 rounded-lg hover:bg-primary/90 text-sm">
                        <i class="fas fa-plus mr-1"></i>
                        Add New Note
                    </button>
                </div>
                <div id="addNoteForm" class="hidden mb-4">
                    <div class="space-y-3">
                        <textarea id="noteText" class="w-full px-3 py-2 border border-primary/30 rounded-lg outline-none resize-none" rows="3" placeholder="Write your note here..."></textarea>
                        <div class="flex items-center justify-end space-x-2">
                            <button onclick="cancelAddNote()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors"><i class="fas fa-times"></i></button>
                            <button onclick="saveNote()" class="p-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors"><i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </div>
                <div id="notesList" class="space-y-3">
                    @forelse($project->notes as $note)
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

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.projects.edit', $project->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block"><i class="fas fa-pencil mr-2"></i>Edit Project</a>
                    <form method="POST" action="{{ route('admin.access.projects.destroy', $project->id) }}" id="deleteProjectForm">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDeleteProject()" class="w-full bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 text-center"><i class="fas fa-trash mr-2"></i>Delete Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// SweetAlert2 for delete confirmation
function confirmDeleteProject() {
    Swal.fire({
        title: 'Delete Project?',
        text: "This project will be permanently deleted. This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteProjectForm').submit();
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
            text: 'Please enter some text for your note.',
            icon: 'warning',
            timer: 2000,
            showConfirmButton: false
        });
        return;
    }
    
    // Show loading
    Swal.fire({
        title: 'Saving...',
        text: 'Please wait while we save your note.',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
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
            entity_type: 'App\\Models\\Project',
            entity_id: {{ $project->id }},
            body: noteText
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add note to list
            addNoteToList(data.data);
            
            // Hide form and clear textarea
            const form = document.getElementById('addNoteForm');
            form.classList.add('hidden');
            textarea.value = '';
            
            // Show success message
            Swal.fire({
                title: 'Note Added!',
                text: 'Your note has been added successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            throw new Error(data.message || 'Failed to save note');
        }
    })
    .catch(error => {
        console.error('Error saving note:', error);
        Swal.fire({
            title: 'Error!',
            text: 'Failed to save note. Please try again.',
            icon: 'error',
            timer: 3000,
            showConfirmButton: false
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
    noteElement.className = 'bg-gray-50 rounded-lg p-3 border border-gray-200';
    noteElement.setAttribute('data-note-id', noteData.id);
    noteElement.innerHTML = `
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-sm text-gray-900">${noteData.body}</p>
                <div class="flex items-center mt-2 text-xs text-gray-500">
                    <i class="fas fa-user mr-1"></i>
                    <span>${noteData.user_name}</span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-1"></i>
                    <span>${noteData.created_at}</span>
                </div>
            </div>
            <button onclick="deleteNote(this)" class="ml-2 p-1 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors">
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
                text: 'Please wait while we delete your note.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
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
                if (data.success) {
                    // Remove note element
                    noteElement.remove();
                    
                    // Show empty state if no notes left
                    const notesList = document.getElementById('notesList');
                    if (notesList.children.length === 0) {
                        notesList.innerHTML = '<div class="text-center text-gray-500 text-sm py-4">No notes yet. Add your first note!</div>';
                    }
                    
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your note has been deleted.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message || 'Failed to delete note');
                }
            })
            .catch(error => {
                console.error('Error deleting note:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to delete note. Please try again.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        }
    });
}
</script>
@endsection