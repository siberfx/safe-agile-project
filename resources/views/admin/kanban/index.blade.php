@extends('layouts.admin')

@section('title', 'Kanban Board - Programma Portaal')

@section('content')
<div class="kanban-container">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kanban Board</h1>
                <p class="text-gray-600 mt-1">Drag and drop tasks between columns</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="add-task-btn" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    Add Task
                </button>
                <button id="refresh-btn" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-all duration-200 border border-gray-300">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Refresh
                </button>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Filters</h3>
                <button id="clear-filters" class="text-xs text-gray-500 hover:text-gray-700 ">
                    <i class="fas fa-times mr-1"></i>
                    Clear All
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" id="search-input" placeholder="Search tasks..." 
                           class="w-full pl-10 pr-4 py-2.5 outline-none rounded-lg transition-all duration-200 text-sm bg-white border border-primary/30">
                </div>
                
                <!-- Priority Filter -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-flag text-gray-400 text-sm"></i>
                    </div>
                    <select id="priority-filter" class="w-full pl-10 pr-4 py-2.5 outline-none rounded-lg transition-all duration-200 text-sm bg-white border border-primary/30 appearance-none">
                        <option value="">All Priorities</option>
                        <option value="high">High Priority</option>
                        <option value="medium">Medium Priority</option>
                        <option value="low">Low Priority</option>
                    </select>
                </div>
                
                <!-- Assignee Filter -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400 text-sm"></i>
                    </div>
                    <select id="assignee-filter" class="w-full pl-10 pr-4 py-2.5 outline-none rounded-lg transition-all duration-200 text-sm bg-white border border-primary/30 appearance-none">
                        <option value="">All Assignees</option>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tasks text-primary text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total</p>
                        <p class="text-xl font-bold text-gray-900" id="total-tasks">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-circle text-gray-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">To Do</p>
                        <p class="text-xl font-bold text-gray-900" id="todo-count">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-play text-yellow-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">In Progress</p>
                        <p class="text-xl font-bold text-gray-900" id="in-progress-count">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-eye text-purple-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Review</p>
                        <p class="text-xl font-bold text-gray-900" id="review-count">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Done</p>
                        <p class="text-xl font-bold text-gray-900" id="done-count">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kanban Board -->
    <div class="relative">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- To Do Column -->
        <div class="kanban-column" data-status="todo">
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-200 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                        <h3 class="font-semibold text-gray-900 text-lg">To Do</h3>
                    </div>
                    <span class="bg-gray-100 text-gray-800 text-sm font-bold px-3 py-1 rounded-full" id="todo-badge">0</span>
                </div>
                <div class="space-y-4 min-h-[500px]" id="todo-tasks">
                    <!-- Tasks will be loaded here -->
                </div>
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="kanban-column" data-status="in_progress">
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-200 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <h3 class="font-semibold text-gray-900 text-lg">In Progress</h3>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-bold px-3 py-1 rounded-full" id="in-progress-badge">0</span>
                </div>
                <div class="space-y-4 min-h-[500px]" id="in-progress-tasks">
                    <!-- Tasks will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Review Column -->
        <div class="kanban-column" data-status="review">
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-200 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <h3 class="font-semibold text-gray-900 text-lg">Review</h3>
                    </div>
                    <span class="bg-purple-100 text-purple-800 text-sm font-bold px-3 py-1 rounded-full" id="review-badge">0</span>
                </div>
                <div class="space-y-4 min-h-[500px]" id="review-tasks">
                    <!-- Tasks will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Done Column -->
        <div class="kanban-column" data-status="done">
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-200 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <h3 class="font-semibold text-gray-900 text-lg">Done</h3>
                    </div>
                    <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded-full" id="done-badge">0</span>
                </div>
                <div class="space-y-4 min-h-[500px]" id="done-tasks">
                    <!-- Tasks will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Task Detail Slide-in Panel -->
    <div id="task-detail-panel" class="fixed top-0 right-0 h-full w-full sm:w-1/2 lg:w-1/3 min-w-[400px] max-w-[600px] bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 border-l border-gray-200">
        <div class="h-full flex flex-col">
            <!-- Panel Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Task Details</h3>
                <button id="close-task-panel" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Panel Content -->
            <div class="flex-1 overflow-y-auto">
                <div id="task-detail-content" class="p-6">
                    <!-- Task content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Panel Overlay -->
    <div id="task-panel-overlay" class="fixed inset-0 bg-black/30 hidden z-40 cursor-pointer"></div>
</div>

<!-- Add Task Modal -->
<div id="add-task-modal" class="fixed inset-0 bg-black/30 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Add New Task</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 ">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Modal Body -->
            <form id="add-task-form" class="p-6">
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Task Title *</label>
                        <input type="text" name="title" required 
                               class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 "
                               placeholder="Enter task title">
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30  resize-none"
                                  placeholder="Describe the task in detail"></textarea>
                    </div>
                    
                    <!-- Priority and Story Points -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                            <select name="priority" required 
                                    class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 ">
                                <option value="">Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Story Points</label>
                            <input type="number" name="story_points" min="0" max="100" 
                                   class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 "
                                   placeholder="0">
                        </div>
                    </div>
                    
                    <!-- Status and Due Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Initial Status</label>
                            <select name="kanban_status" 
                                    class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 ">
                                <option value="todo" selected>To Do</option>
                                <option value="in_progress">In Progress</option>
                                <option value="review">Review</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                            <input type="date" name="due_date" 
                                   class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 ">
                        </div>
                    </div>
                    
                    <!-- Assignee -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assignee</label>
                        <select name="assigned_to" 
                                class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 ">
                            <option value="">Select Assignee</option>
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    
                    <!-- Tags -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <div class="flex flex-wrap gap-2 mb-2" id="tags-container">
                            <!-- Tags will be added here -->
                        </div>
                        <div class="flex gap-2">
                            <input type="text" id="tag-input" 
                                   class="flex-1 px-4 py-2 outline-none rounded-lg bg-white border border-primary/30 "
                                   placeholder="Add a tag and press Enter">
                            <button type="button" id="add-tag-btn" 
                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 ">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="3" 
                                  class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30  resize-none"
                                  placeholder="Additional notes or comments"></textarea>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <button type="button" id="cancel-add-task" 
                            class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium ">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-2"></i>
                        Add Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .kanban-column.drag-over {
            background-color: #f8fafc;
            outline: 2px dashed #154273;
            outline-offset: -2px;
        }

        .task-card {
            transition: all 0.2s ease-out;
            cursor: grab;
        }

        .task-card:active {
            cursor: grabbing;
        }

        .task-card:hover:not(.dragging) {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .task-card.dragging {
            opacity: 0.9;
            transform: scale(0.9);
            transition: none !important;
            z-index: 1000;
            box-shadow: 0 15px 30px rgba(21, 66, 115, 0.25) !important;
            border: 2px solid #154273 !important;
            cursor: grabbing !important;
        }

        .drop-indicator {
            animation: pulse 2s ease-in-out infinite;
            backdrop-filter: blur(1px);
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 0.7;
                transform: scale(1);
            }
            50% {
                opacity: 0.9;
                transform: scale(1.01);
            }
        }

        /* Form elements performance */
        select, input, textarea {
            transition: none !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: none;
        }

        /* Custom select styling for better performance */
        select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }

        /* Modal performance */
        #edit-task-modal, #add-task-modal {
            transform: translateZ(0);
            backface-visibility: hidden;
            perspective: 1000px;
            will-change: transform;
        }

        /* Select dropdown performance */
        select:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(21, 66, 115, 0.2);
        }

        /* Disable browser default animations */
        * {
            -webkit-tap-highlight-color: transparent;
        }

        select, input, textarea {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Primary color customizations */
        .bg-primary {
            background-color: #154273 !important;
        }

        .text-primary {
            color: #154273 !important;
        }

        .border-primary {
            border-color: #154273 !important;
        }

        .bg-primary\/10 {
            background-color: rgba(21, 66, 115, 0.1) !important;
        }

        .border-primary\/20 {
            border-color: rgba(21, 66, 115, 0.2) !important;
        }

        .hover\:border-primary\/20:hover {
            border-color: rgba(21, 66, 115, 0.2) !important;
        }

        /* Enhanced shadows */
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .shadow-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Smooth animations - exclude dragging elements */
        *:not(.dragging) {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Disable transitions during drag */
        .dragging,
        .dragging * {
            transition: none !important;
        }
    </style>
@endpush

@push('scripts')
<script>
class KanbanBoard {
    constructor() {
        this.tasks = [];
        this.filteredTasks = [];
        this.users = [];
        this.draggedTask = null;
        this.lastFeedbackTime = 0;
        this.feedbackThrottle = 200; // 200ms throttle for better performance
        this.isDragging = false;
        this.filterTimeout = null;
        this.tagManagementSetup = false;
        this.filterSetup = false;
        this.eventListenersSetup = false;
        this.dragDropSetup = false;
        this.init();
    }

    init() {
        console.log('Initializing Kanban Board...');
        if (!this.eventListenersSetup) {
            this.setupEventListeners();
            this.eventListenersSetup = true;
        }
        this.loadUsers();
        this.loadTasks();
        this.loadStats();
    }

    setupEventListeners() {
        // Prevent multiple setups
        if (this.eventListenersSetup) return;
        
        // Add task button
        const addTaskBtn = document.getElementById('add-task-btn');
        if (addTaskBtn && !addTaskBtn.hasAttribute('data-listener-added')) {
            addTaskBtn.addEventListener('click', () => {
                document.getElementById('add-task-modal').classList.remove('hidden');
                this.resetModal();
            });
            addTaskBtn.setAttribute('data-listener-added', 'true');
        }

        // Close modal buttons
        const closeModalBtn = document.getElementById('close-modal');
        if (closeModalBtn && !closeModalBtn.hasAttribute('data-listener-added')) {
            closeModalBtn.addEventListener('click', () => {
                this.closeModal();
            });
            closeModalBtn.setAttribute('data-listener-added', 'true');
        }

        const cancelBtn = document.getElementById('cancel-add-task');
        if (cancelBtn && !cancelBtn.hasAttribute('data-listener-added')) {
            cancelBtn.addEventListener('click', () => {
                this.closeModal();
            });
            cancelBtn.setAttribute('data-listener-added', 'true');
        }

        // Add task form
        const addTaskForm = document.getElementById('add-task-form');
        if (addTaskForm && !addTaskForm.hasAttribute('data-listener-added')) {
            addTaskForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.addTask();
            });
            addTaskForm.setAttribute('data-listener-added', 'true');
        }

        // Refresh button
        const refreshBtn = document.getElementById('refresh-btn');
        if (refreshBtn && !refreshBtn.hasAttribute('data-listener-added')) {
            refreshBtn.addEventListener('click', () => {
                this.loadTasks();
                this.loadStats();
            });
            refreshBtn.setAttribute('data-listener-added', 'true');
        }

        // Tag management (only once)
        if (!this.tagManagementSetup) {
            this.setupTagManagement();
            this.tagManagementSetup = true;
        }

        // Filter management (only once)
        if (!this.filterSetup) {
            this.setupFilters();
            this.filterSetup = true;
        }
        
        // Mark as setup
        this.eventListenersSetup = true;

        // Modal backdrop click
        const addTaskModal = document.getElementById('add-task-modal');
        if (addTaskModal && !addTaskModal.hasAttribute('data-listener-added')) {
            addTaskModal.addEventListener('click', (e) => {
                if (e.target.id === 'add-task-modal') {
                    this.closeModal();
                }
            });
            addTaskModal.setAttribute('data-listener-added', 'true');
        }

        // Setup drag and drop using event delegation (only once)
        if (!this.dragDropSetup) {
            // Dragover event
            document.addEventListener('dragover', (e) => {
                if (!this.isDragging) return;
                
                const column = e.target.closest('.kanban-column');
                if (column) {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    column.classList.add('drag-over');
                    
                    // Show visual feedback for reordering (both same and different columns)
                    if (this.draggedTask) {
                        this.showReorderFeedback(e, column);
                    }
                }
            });

            // Dragleave event
            document.addEventListener('dragleave', (e) => {
                if (!this.isDragging) return;
                
                const column = e.target.closest('.kanban-column');
                if (column && !column.contains(e.relatedTarget)) {
                    column.classList.remove('drag-over');
                    
                    // Remove drop indicators
                    const status = column.dataset.status;
                    const statusMap = {
                        'todo': 'todo',
                        'in_progress': 'in-progress',
                        'review': 'review',
                        'done': 'done'
                    };
                    const htmlId = statusMap[status] || status;
                    const container = document.getElementById(`${htmlId}-tasks`);
                    if (container) {
                        container.querySelectorAll('.drop-indicator').forEach(indicator => {
                            indicator.remove();
                        });
                    }
                }
            });

            // Drop event
            document.addEventListener('drop', (e) => {
                if (!this.isDragging) return;
                
                e.preventDefault();
                
                // Find the column - either directly or through drop indicator
                let column = e.target.closest('.kanban-column');
                
                // If dropped on drop indicator, find its parent column
                if (!column && e.target.classList.contains('drop-indicator')) {
                    const container = e.target.closest('[id$="-tasks"]');
                    if (container) {
                        column = container.closest('.kanban-column');
                    }
                }
                
                // If still no column, try to find by mouse position
                if (!column) {
                    const elements = document.elementsFromPoint(e.clientX, e.clientY);
                    column = elements.find(el => el.classList.contains('kanban-column'));
                }
                
                if (column) {
                    column.classList.remove('drag-over');
                    
                    // Remove ALL drop indicators from ALL columns
                    document.querySelectorAll('.drop-indicator').forEach(indicator => {
                        indicator.remove();
                    });
                    
                    const newStatus = column.dataset.status;
                    
                    if (this.draggedTask) {
                        if (this.draggedTask.status !== newStatus) {
                            // Different column - update status and reorder
                            this.updateTaskStatusAndReorder(this.draggedTask.id, newStatus, e, column);
                        } else {
                            // Same column - reorder tasks
                            this.reorderTasks(e, column);
                        }
                    }
                }
            });
            
            this.dragDropSetup = true;
        }
    }

    async loadUsers() {
        try {
            const response = await fetch('/api/users', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            this.users = result.data;
            this.populateAssigneeSelect();
        } catch (error) {
            console.error('Error loading users:', error);
        }
    }

    populateAssigneeSelect() {
        const select = document.querySelector('select[name="assigned_to"]');
        const filterSelect = document.getElementById('assignee-filter');
        
        if (select) {
            // Clear existing options except the first one
            select.innerHTML = '<option value="">Select Assignee</option>';
            
            this.users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name;
                select.appendChild(option);
            });
        }

        if (filterSelect) {
            // Clear existing options except the first one
            filterSelect.innerHTML = '<option value="">All Assignees</option>';
            
            this.users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name;
                filterSelect.appendChild(option);
            });
        }
    }

    async loadTasks() {
        try {
            const response = await fetch('/api/tasks', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            this.tasks = result.data; // Laravel 12 API response format
            this.filteredTasks = [...this.tasks];
            this.renderTasks();
        } catch (error) {
            console.error('Error loading tasks:', error);
            this.showError('Failed to load tasks');
        }
    }

    async loadStats() {
        try {
            const response = await fetch('/api/tasks/stats/kanban', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            this.updateStats(result.data); // Laravel 12 API response format
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }

    renderTasks() {
        // Use filtered tasks if filters are active, otherwise use all tasks
        const tasksToRender = this.filteredTasks.length > 0 ? this.filteredTasks : this.tasks;
        
        const columns = [
            { status: 'todo', id: 'todo' },
            { status: 'in_progress', id: 'in-progress' },
            { status: 'review', id: 'review' },
            { status: 'done', id: 'done' }
        ];
        
        // Use DocumentFragment for better performance
        const fragments = {};
        columns.forEach(column => {
            fragments[column.id] = document.createDocumentFragment();
        });
        
        columns.forEach(column => {
            const container = document.getElementById(`${column.id}-tasks`);
            const badge = document.getElementById(`${column.id}-badge`);
            
            // Check if elements exist
            if (!container || !badge) {
                console.error(`Element not found: ${column.id}-tasks or ${column.id}-badge`);
                return;
            }
            
            const tasks = tasksToRender.filter(task => task.status === column.status);
            
            // Sort tasks by kanban_order for consistent display
            tasks.sort((a, b) => (a.kanban_order || 0) - (b.kanban_order || 0));
            
            badge.textContent = tasks.length;
            
            // Clear container efficiently
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }

            if (tasks.length === 0) {
                const emptyState = document.createElement('div');
                emptyState.className = 'text-center py-8 text-gray-400';
                emptyState.innerHTML = `
                    <i class="fas fa-inbox text-2xl mb-2"></i>
                    <p class="text-sm">No tasks</p>
                `;
                container.appendChild(emptyState);
                return;
            }

            // Create task elements and append to fragment
            tasks.forEach(task => {
                const taskElement = this.createTaskElement(task);
                fragments[column.id].appendChild(taskElement);
            });
            
            // Append fragment to container (single DOM operation)
            container.appendChild(fragments[column.id]);
        });
    }

    createTaskElement(task) {
        const div = document.createElement('div');
        div.className = 'task-card bg-white rounded-xl p-5 shadow-lg border border-gray-100 cursor-pointer hover:shadow-xl transition-all duration-200 group hover:border-primary/20';
        div.draggable = true;
        div.dataset.taskId = task.id;
        
        // Add click event to open detail panel
        div.addEventListener('click', (e) => {
            // Don't open panel if clicking on edit/delete buttons
            if (e.target.closest('button')) return;
            this.openTaskDetail(task.id);
        });

        const priorityColors = {
            'high': 'bg-red-100 text-red-800 border-red-200',
            'medium': 'bg-primary/10 text-primary border-primary/20',
            'low': 'bg-green-100 text-green-800 border-green-200'
        };

        const priorityColor = priorityColors[task.priority] || 'bg-gray-100 text-gray-800';

        const priorityIcon = {
            'high': 'fas fa-arrow-up',
            'medium': 'fas fa-minus',
            'low': 'fas fa-arrow-down'
        };

        const getInitials = (name) => {
            if (!name) return '?';
            return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
        };

        const getAvatarColor = (name) => {
            if (!name) return 'bg-gray-400';
            const colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-yellow-500'];
            const index = name.length % colors.length;
            return colors[index];
        };

        div.innerHTML = `
            <!-- Task Header -->
            <div class="flex items-start justify-between mb-3">
                <h4 class="font-medium text-gray-900 text-sm leading-tight flex-1 mr-2">${this.escapeHtml(task.title)}</h4>
                <div class="flex items-center space-x-1">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border ${priorityColor}">
                        <i class="${priorityIcon[task.priority] || 'fas fa-minus'} mr-1"></i>
                        ${task.priority}
                    </span>
                    <div class="flex items-center space-x-1">
                        <button onclick="kanbanBoard.editTask(${task.id})" class="text-gray-400 hover:text-blue-600 p-1 ">
                            <i class="fas fa-edit text-xs"></i>
                        </button>
                        <button onclick="kanbanBoard.deleteTask(${task.id})" class="text-gray-400 hover:text-red-600 p-1 ">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Task Description -->
            ${task.description ? `<p class="text-gray-600 text-sm mb-3 line-clamp-2">${this.escapeHtml(task.description)}</p>` : ''}
            
            <!-- Task Meta -->
            <div class="space-y-2">
                <!-- Assignee -->
                ${task.assignee ? `
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full ${getAvatarColor(task.assignee)} flex items-center justify-center text-white text-xs font-medium">
                            ${getInitials(task.assignee)}
                        </div>
                        <span class="text-xs text-gray-600">${this.escapeHtml(task.assignee)}</span>
                    </div>
                ` : `
                    <button onclick="kanbanBoard.assignTask(${task.id})" class="flex items-center space-x-2 text-gray-400 hover:text-blue-600 text-xs">
                        <i class="fas fa-user-plus"></i>
                        <span>Assign</span>
                    </button>
                `}
                
                <!-- Story Points & Tags -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1">
                        ${task.story_points ? `<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">${task.story_points} pts</span>` : ''}
                        ${task.tags && task.tags.length > 0 ? task.tags.slice(0, 2).map(tag => `<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">${this.escapeHtml(tag)}</span>`).join('') : ''}
                        ${task.tags && task.tags.length > 2 ? `<span class="text-gray-500 text-xs">+${task.tags.length - 2}</span>` : ''}
                    </div>
                    ${task.due_date ? `
                        <span class="text-xs ${new Date(task.due_date) < new Date() ? 'text-red-600' : 'text-gray-500'}">
                            <i class="fas fa-calendar mr-1"></i>
                            ${new Date(task.due_date).toLocaleDateString()}
                        </span>
                    ` : ''}
                </div>
            </div>
        `;

        // Add drag event listeners
        div.addEventListener('dragstart', (e) => {
            this.draggedTask = task;
            this.isDragging = true;
            e.dataTransfer.effectAllowed = 'move';
            div.classList.add('dragging');
            
            // Create custom drag image
            const dragImage = div.cloneNode(true);
            dragImage.style.transform = 'scale(0.95)';
            dragImage.style.opacity = '0.9';
            dragImage.style.position = 'absolute';
            dragImage.style.top = '-1000px';
            dragImage.style.left = '-1000px';
            dragImage.style.zIndex = '9999';
            dragImage.style.pointerEvents = 'none';
            dragImage.style.width = div.offsetWidth + 'px';
            dragImage.style.height = div.offsetHeight + 'px';
            
            document.body.appendChild(dragImage);
            e.dataTransfer.setDragImage(dragImage, div.offsetWidth / 2, div.offsetHeight / 2);
            
            // Clean up drag image after a short delay
            setTimeout(() => {
                if (dragImage && document.body.contains(dragImage)) {
                    document.body.removeChild(dragImage);
                }
            }, 100);
        });

        div.addEventListener('dragend', () => {
            this.draggedTask = null;
            this.isDragging = false;
            div.classList.remove('dragging');
            
            // Remove ALL drop indicators and drag-over classes
            document.querySelectorAll('.drop-indicator').forEach(indicator => {
                indicator.remove();
            });
            document.querySelectorAll('.kanban-column').forEach(col => {
                col.classList.remove('drag-over');
            });
        });

        return div;
    }

    async updateTaskStatus(taskId, newStatus) {
        try {
            const response = await fetch(`/api/tasks/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ kanban_status: newStatus })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            
            // Update local task data
            const task = this.tasks.find(t => t.id === taskId);
            if (task) {
                task.status = newStatus;
            }

            this.renderTasks();
            this.loadStats();
        } catch (error) {
            console.error('Error updating task status:', error);
            this.showError('Failed to update task status');
        }
    }

    reorderTasks(e, column) {
        console.log('reorderTasks called', e, column);
        const status = column.dataset.status;
        
        // Map status to correct HTML ID format
        const statusMap = {
            'todo': 'todo',
            'in_progress': 'in-progress',
            'review': 'review',
            'done': 'done'
        };
        
        const htmlId = statusMap[status] || status;
        const container = document.getElementById(`${htmlId}-tasks`);
        
        if (!container) {
            console.error(`Container not found for status: ${status} (looking for: ${htmlId}-tasks)`);
            return;
        }
        
        const draggedElement = document.querySelector('.task-card.dragging');
        if (!draggedElement) {
            console.error('No dragged element found');
            return;
        }
        
        console.log('Dragged element:', draggedElement);
        
        // Get the position where the task should be inserted
        const afterElement = this.getDragAfterElement(container, e.clientY);
        console.log('After element:', afterElement);
        
        // Don't remove and re-add, just move the element
        if (afterElement == null) {
            container.appendChild(draggedElement);
            console.log('Appended to end');
        } else {
            container.insertBefore(draggedElement, afterElement);
            console.log('Inserted before element');
        }
        
        // Update kanban_order for all tasks in this column
        this.updateTaskOrder(status);
    }

    showReorderFeedback(e, column) {
        // Throttle feedback to prevent flash effect - increased throttle time
        const now = Date.now();
        if (now - this.lastFeedbackTime < 200) { // Increased from 100ms to 200ms
            return;
        }
        this.lastFeedbackTime = now;
        
        // Don't show feedback if not actually dragging
        if (!this.isDragging || !this.draggedTask) {
            return;
        }
        
        const status = column.dataset.status;
        
        // Map status to correct HTML ID format
        const statusMap = {
            'todo': 'todo',
            'in_progress': 'in-progress',
            'review': 'review',
            'done': 'done'
        };
        
        const htmlId = statusMap[status] || status;
        const container = document.getElementById(`${htmlId}-tasks`);
        if (!container) return;
        
        const afterElement = this.getDragAfterElement(container, e.clientY);
        
        // Only remove indicators from this specific container, not all
        container.querySelectorAll('.drop-indicator').forEach(indicator => {
            indicator.remove();
        });
        
        // Determine if it's same column or different column
        const isSameColumn = this.draggedTask && this.draggedTask.status === status;
        
        // Create a more prominent drop zone with better performance
        const indicator = document.createElement('div');
        indicator.className = 'drop-indicator bg-primary/10 border-2 border-dashed border-primary rounded-lg';
        indicator.style.cssText = `
            min-height: 60px;
            margin: 8px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            pointer-events: none;
            will-change: auto;
        `;
        
        // Add text content based on column type
        const text = document.createElement('span');
        text.className = 'text-primary font-medium text-sm';
        text.textContent = isSameColumn ? 'Drop here to reorder' : 'Drop here to move task';
        indicator.appendChild(text);
        
        // Add appropriate icon
        const icon = document.createElement('i');
        icon.className = isSameColumn ? 'fas fa-arrows-alt-v text-primary ml-2' : 'fas fa-arrow-right text-primary ml-2';
        indicator.appendChild(icon);
        
        if (afterElement == null) {
            container.appendChild(indicator);
        } else {
            container.insertBefore(indicator, afterElement);
        }
    }

    getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.task-card:not(.dragging)')];
        
        if (draggableElements.length === 0) {
            return null;
        }
        
        // Find the element that the mouse is closest to
        for (let i = 0; i < draggableElements.length; i++) {
            const element = draggableElements[i];
            const box = element.getBoundingClientRect();
            
            // If mouse is above the middle of this element, insert before it
            if (y < box.top + box.height / 2) {
                return element;
            }
        }
        
        return null; // Drop at the end
    }

    async updateTaskOrder(status) {
        // Map status to correct HTML ID format
        const statusMap = {
            'todo': 'todo',
            'in_progress': 'in-progress',
            'review': 'review',
            'done': 'done'
        };
        
        const htmlId = statusMap[status] || status;
        const container = document.getElementById(`${htmlId}-tasks`);
        if (!container) return;
        
        const tasks = Array.from(container.querySelectorAll('.task-card'));
        console.log(`Updating order for ${tasks.length} tasks in ${status} column`);
        
        const updates = tasks.map((taskElement, index) => {
            const taskId = parseInt(taskElement.dataset.taskId);
            const newOrder = index + 1;
            
            console.log(`Task ${taskId} -> order ${newOrder}`);
            
            // Update local task data
            const task = this.tasks.find(t => t.id === taskId);
            if (task) {
                task.kanban_order = newOrder;
            }
            
            return { id: taskId, kanban_order: newOrder };
        });
        
        // Update all tasks in this column
        for (const update of updates) {
            try {
                console.log(`Updating task ${update.id} with order ${update.kanban_order}`);
                const response = await fetch(`/api/tasks/${update.id}`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        kanban_order: update.kanban_order
                    })
                });
                
                if (!response.ok) {
                    console.error(`Failed to update task ${update.id}: ${response.status}`);
                } else {
                    console.log(`Successfully updated task ${update.id}`);
                }
            } catch (error) {
                console.error('Error updating task order:', error);
            }
        }
    }

    async updateTaskStatusAndReorder(taskId, newStatus, e, column) {
        try {
            // First update the status
            const response = await fetch(`/api/tasks/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    kanban_status: newStatus
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Status updated:', result);

            // Update local task data
            const task = this.tasks.find(t => t.id === taskId);
            if (task) {
                task.status = newStatus;
            }

            // Refresh the display first
            this.renderTasks();
            this.loadStats();
            
            // Then reorder the task in the new column (after DOM is updated)
            setTimeout(() => {
                this.reorderTasksAfterStatusChange(taskId, newStatus, e, column);
            }, 100);
            
        } catch (error) {
            console.error('Error updating task status and reordering:', error);
            this.showError('Failed to update task status');
        }
    }

    reorderTasksAfterStatusChange(taskId, newStatus, e, column) {
        console.log('reorderTasksAfterStatusChange called', taskId, newStatus);
        
        // Map status to correct HTML ID format
        const statusMap = {
            'todo': 'todo',
            'in_progress': 'in-progress',
            'review': 'review',
            'done': 'done'
        };
        
        const htmlId = statusMap[newStatus] || newStatus;
        const container = document.getElementById(`${htmlId}-tasks`);
        
        if (!container) {
            console.error(`Container not found for status: ${newStatus} (looking for: ${htmlId}-tasks)`);
            return;
        }
        
        // Find the task element by taskId
        const taskElement = container.querySelector(`[data-task-id="${taskId}"]`);
        if (!taskElement) {
            console.error(`Task element not found for taskId: ${taskId}`);
            return;
        }
        
        // Get the position where the task should be inserted
        const afterElement = this.getDragAfterElement(container, e.clientY);
        console.log('After element:', afterElement);
        
        // Move the task element
        if (afterElement == null) {
            container.appendChild(taskElement);
            console.log('Appended to end');
        } else {
            container.insertBefore(taskElement, afterElement);
            console.log('Inserted before element');
        }
        
        // Update kanban_order for all tasks in this column
        this.updateTaskOrder(newStatus);
    }

    setupTagManagement() {
        const tagInput = document.getElementById('tag-input');
        const addTagBtn = document.getElementById('add-tag-btn');
        const tagsContainer = document.getElementById('tags-container');
        
        // Add tag on Enter key
        tagInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.addTag();
            }
        });
        
        // Add tag on button click
        addTagBtn.addEventListener('click', () => {
            this.addTag();
        });
    }

    setupFilters() {
        const searchInput = document.getElementById('search-input');
        const priorityFilter = document.getElementById('priority-filter');
        const assigneeFilter = document.getElementById('assignee-filter');
        const clearFiltersBtn = document.getElementById('clear-filters');

        // Search filter
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                this.applyFilters();
            });
        }

        // Priority filter
        if (priorityFilter) {
            priorityFilter.addEventListener('change', () => {
                this.debouncedApplyFilters();
            });
        }

        // Assignee filter
        if (assigneeFilter) {
            assigneeFilter.addEventListener('change', () => {
                this.debouncedApplyFilters();
            });
        }

        // Clear filters
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', () => {
                this.clearFilters();
            });
        }
    }

    debouncedApplyFilters() {
        // Clear existing timeout
        if (this.filterTimeout) {
            clearTimeout(this.filterTimeout);
        }
        
        // Set new timeout
        this.filterTimeout = setTimeout(() => {
            this.applyFilters();
        }, 50); // 50ms debounce
    }

    applyFilters() {
        const searchTerm = document.getElementById('search-input')?.value.toLowerCase() || '';
        const priorityFilter = document.getElementById('priority-filter')?.value || '';
        const assigneeFilter = document.getElementById('assignee-filter')?.value || '';

        this.filteredTasks = this.tasks.filter(task => {
            const matchesSearch = !searchTerm || 
                task.title.toLowerCase().includes(searchTerm) ||
                (task.description && task.description.toLowerCase().includes(searchTerm)) ||
                (task.assignee && task.assignee.toLowerCase().includes(searchTerm));

            const matchesPriority = !priorityFilter || task.priority === priorityFilter;
            const matchesAssignee = !assigneeFilter || task.assignee_id == assigneeFilter;

            return matchesSearch && matchesPriority && matchesAssignee;
        });

        this.renderFilteredTasks();
    }

    renderFilteredTasks() {
        // Use the optimized renderTasks method
        this.renderTasks();
    }

    clearFilters() {
        document.getElementById('search-input').value = '';
        document.getElementById('priority-filter').value = '';
        document.getElementById('assignee-filter').value = '';
        
        this.filteredTasks = this.tasks;
        this.renderFilteredTasks();
    }

    addTag() {
        const tagInput = document.getElementById('tag-input');
        const tagText = tagInput.value.trim();
        
        if (tagText && !this.tagExists(tagText)) {
            const tagElement = document.createElement('span');
            tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800';
            tagElement.innerHTML = `
                ${tagText}
                <button type="button" class="ml-2 text-blue-600 hover:text-blue-800" onclick="this.parentElement.remove()">
                    <i class="fas fa-times text-xs"></i>
                </button>
            `;
            
            document.getElementById('tags-container').appendChild(tagElement);
            tagInput.value = '';
        }
    }

    tagExists(tagText) {
        const existingTags = Array.from(document.querySelectorAll('#tags-container span')).map(span => 
            span.textContent.trim().replace('×', '').trim()
        );
        return existingTags.includes(tagText);
    }

    getTags() {
        return Array.from(document.querySelectorAll('#tags-container span')).map(span => 
            span.textContent.trim().replace('×', '').trim()
        );
    }

    resetModal() {
        const form = document.getElementById('add-task-form');
        form.reset();
        document.getElementById('tags-container').innerHTML = '';
        document.getElementById('tag-input').value = '';
    }

    closeModal() {
        const modal = document.getElementById('add-task-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
        this.resetModal();
    }

    async addTask() {
        const form = document.getElementById('add-task-form');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        // Add tags
        data.tags = this.getTags();

        try {
            const response = await fetch('/api/tasks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            this.tasks.push(result.data);
            this.filteredTasks.push(result.data);
            this.renderTasks();
            this.loadStats();
            
            this.closeModal();
            
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Task created successfully!',
                timer: 2000,
                showConfirmButton: false
            });
        } catch (error) {
            console.error('Error creating task:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to create task. Please try again.',
            });
        }
    }

    updateStats(stats) {
        const elements = {
            'total-tasks': stats.total,
            'todo-count': stats.todo,
            'in-progress-count': stats.in_progress,
            'review-count': stats.review,
            'done-count': stats.done
        };

        Object.entries(elements).forEach(([id, value]) => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = value;
            } else {
                console.error(`Element not found: ${id}`);
            }
        });
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    showSuccess(message) {
        // You can implement a toast notification here
        console.log('Success:', message);
    }

    showError(message) {
        // You can implement a toast notification here
        console.error('Error:', message);
        alert(message); // Fallback to alert for now
    }

    // Edit Task
    async editTask(taskId) {
        const task = this.tasks.find(t => t.id === taskId);
        if (!task) return;
        
        // Debug: Log task data
        console.log('Edit Task - Current task:', task);
        console.log('Edit Task - Current kanban_status:', task.kanban_status);

        // Create edit modal HTML
        const editModalHTML = `
            <div id="edit-task-modal" class="fixed inset-0 bg-black/30 z-50" style="will-change: auto;">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto" style="will-change: auto;">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900">Edit Task</h3>
                            <button onclick="document.getElementById('edit-task-modal').remove()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <!-- Modal Body -->
                        <form id="edit-task-form" class="p-6">
                            <div class="space-y-6">
                                <!-- Title -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Task Title *</label>
                                    <input type="text" id="edit-title" required value="${this.escapeHtml(task.title)}"
                                           class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30"
                                           placeholder="Enter task title">
                                </div>
                                
                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea id="edit-description" rows="4" 
                                              class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 resize-none"
                                              placeholder="Describe the task in detail">${this.escapeHtml(task.description || '')}</textarea>
                                </div>
                                
                                <!-- Priority and Story Points -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                                        <select id="edit-priority" required 
                                                class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30">
                                            <option value="low" ${task.priority === 'low' ? 'selected' : ''}>Low</option>
                                            <option value="medium" ${task.priority === 'medium' ? 'selected' : ''}>Medium</option>
                                            <option value="high" ${task.priority === 'high' ? 'selected' : ''}>High</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Story Points</label>
                                        <input type="number" id="edit-story-points" min="0" max="100" value="${task.story_points || ''}"
                                               class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30"
                                               placeholder="0">
                                    </div>
                                </div>
                                
                                <!-- Status and Due Date -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select id="edit-status" 
                                                class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30">
                                            <option value="todo" ${(task.kanban_status || task.status) === 'todo' ? 'selected' : ''}>To Do</option>
                                            <option value="in_progress" ${(task.kanban_status || task.status) === 'in_progress' ? 'selected' : ''}>In Progress</option>
                                            <option value="review" ${(task.kanban_status || task.status) === 'review' ? 'selected' : ''}>Review</option>
                                            <option value="done" ${(task.kanban_status || task.status) === 'done' ? 'selected' : ''}>Done</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                                        <input type="date" id="edit-due-date" value="${task.due_date || ''}"
                                               class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30">
                                    </div>
                                </div>
                                
                                <!-- Assignee -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Assignee</label>
                                    <select id="edit-assignee" 
                                            class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30">
                                        <option value="">Select Assignee</option>
                                        ${this.users.map(user => 
                                            `<option value="${user.id}" ${user.id == task.assigned_to ? 'selected' : ''}>${this.escapeHtml(user.name)}</option>`
                                        ).join('')}
                                    </select>
                                </div>
                                
                                <!-- Notes -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                    <textarea id="edit-notes" rows="3" 
                                              class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 resize-none"
                                              placeholder="Additional notes or comments">${this.escapeHtml(task.notes || '')}</textarea>
                                </div>
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                                <button type="button" onclick="document.getElementById('edit-task-modal').remove()" 
                                        class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 font-medium">
                                    <i class="fas fa-save mr-2"></i>
                                    Update Task
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;

        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', editModalHTML);

        // Setup form submission
        document.getElementById('edit-task-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = {
                title: document.getElementById('edit-title').value,
                description: document.getElementById('edit-description').value,
                priority: document.getElementById('edit-priority').value,
                story_points: document.getElementById('edit-story-points').value,
                kanban_status: document.getElementById('edit-status').value,
                due_date: document.getElementById('edit-due-date').value,
                assigned_to: document.getElementById('edit-assignee').value,
                notes: document.getElementById('edit-notes').value
            };

            try {
                const response = await fetch(`/api/tasks/${taskId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    const updatedTask = await response.json();
                    const taskIndex = this.tasks.findIndex(t => t.id === taskId);
                    if (taskIndex !== -1) {
                        this.tasks[taskIndex] = updatedTask.data;
                    }
                    
                    // Update filtered tasks if filters are active
                    if (this.filteredTasks.length > 0) {
                        const filteredIndex = this.filteredTasks.findIndex(t => t.id === taskId);
                        if (filteredIndex !== -1) {
                            this.filteredTasks[filteredIndex] = updatedTask.data;
                        }
                    }
                    
                    this.renderTasks();
                    this.loadStats();
                    
                    // Update the detail panel if it's open for this task
                    const panel = document.getElementById('task-detail-panel');
                    if (!panel.classList.contains('translate-x-full')) {
                        this.loadTaskDetailContent(updatedTask.data);
                    }
                    
                    // Close modal
                    document.getElementById('edit-task-modal').remove();
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Task updated successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to update task. Please try again.',
                    });
                }
            } catch (error) {
                console.error('Error updating task:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while updating the task.',
                });
            }
        });

        // Setup backdrop click
        document.getElementById('edit-task-modal').addEventListener('click', (e) => {
            if (e.target.id === 'edit-task-modal') {
                document.getElementById('edit-task-modal').remove();
            }
        });
    }



    // Delete Task
    async deleteTask(taskId) {
        const task = this.tasks.find(t => t.id === taskId);
        const taskTitle = task ? task.title : 'this task';
        
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete "${taskTitle}". This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        });

        if (result.isConfirmed) {
            try {
                const response = await fetch(`/api/tasks/${taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'same-origin'
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                // Remove task from local array
                this.tasks = this.tasks.filter(t => t.id !== taskId);
                this.filteredTasks = this.filteredTasks.filter(t => t.id !== taskId);
                this.renderTasks();
                this.loadStats();
                
                // Close the detail panel if it's open for this task
                this.closeTaskDetail();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Task has been deleted successfully.',
                    timer: 2000,
                    showConfirmButton: false
                });
            } catch (error) {
                console.error('Error deleting task:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to delete task. Please try again.',
                });
            }
        }
    }

    // Assign Task
    async assignTask(taskId) {
        const task = this.tasks.find(t => t.id === taskId);
        if (!task) return;

        // Create user options for SweetAlert2
        const userOptions = this.users.map(user => 
            `<option value="${user.id}" ${user.id == task.assignee_id ? 'selected' : ''}>${user.name}</option>`
        ).join('');

        const { value: assigneeId } = await Swal.fire({
            title: 'Assign Task',
            html: `
                <div class="text-left">
                    <p class="text-gray-600 mb-4">Assign "${task.title}" to:</p>
                    <select id="swal-assignee" class="swal2-input">
                        <option value="">Unassigned</option>
                        ${userOptions}
                    </select>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Assign',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#154273',
            cancelButtonColor: '#6b7280',
            preConfirm: () => {
                return document.getElementById('swal-assignee').value;
            }
        });

        if (assigneeId !== undefined) {
            try {
                const response = await fetch(`/api/tasks/${taskId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ assigned_to: assigneeId || null })
                });

                if (response.ok) {
                    const updatedTask = await response.json();
                    const taskIndex = this.tasks.findIndex(t => t.id === taskId);
                    if (taskIndex !== -1) {
                        this.tasks[taskIndex] = updatedTask.data;
                        this.renderTasks();
                    }
                    
                    const assigneeName = assigneeId ? this.users.find(u => u.id == assigneeId)?.name : 'Unassigned';
                    Swal.fire({
                        icon: 'success',
                        title: 'Assigned!',
                        text: `Task has been assigned to ${assigneeName}.`,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to assign task. Please try again.',
                    });
                }
            } catch (error) {
                console.error('Error assigning task:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while assigning the task.',
                });
            }
        }
    }


    // Update Task (generic method)
    async updateTask(taskId, data) {
        try {
            const response = await fetch(`/api/tasks/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin',
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            
            // Update task in local array
            const taskIndex = this.tasks.findIndex(t => t.id === taskId);
            if (taskIndex !== -1) {
                this.tasks[taskIndex] = result.data;
            }

            this.renderTasks();
            this.showSuccess('Task updated successfully');
        } catch (error) {
            console.error('Error updating task:', error);
            this.showError('Failed to update task');
        }
    }

    // Task Detail Panel Methods
    openTaskDetail(taskId) {
        const task = this.tasks.find(t => t.id === taskId);
        if (!task) return;

        // Show overlay
        document.getElementById('task-panel-overlay').classList.remove('hidden');
        
        // Load task content
        this.loadTaskDetailContent(task);
        
        // Slide in panel
        const panel = document.getElementById('task-detail-panel');
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    closeTaskDetail() {
        const panel = document.getElementById('task-detail-panel');
        const overlay = document.getElementById('task-panel-overlay');
        
        // Slide out panel
        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        
        // Hide overlay
        overlay.classList.add('hidden');
        
        // Restore body scroll
        document.body.style.overflow = '';
    }

    loadTaskDetailContent(task) {
        console.log('Loading task detail for:', task);
        const content = document.getElementById('task-detail-content');
        
        const priorityColors = {
            'high': 'bg-red-100 text-red-800 border-red-200',
            'medium': 'bg-primary/10 text-primary border-primary/20',
            'low': 'bg-green-100 text-green-800 border-green-200'
        };

        const statusColors = {
            'todo': 'bg-gray-100 text-gray-800',
            'in_progress': 'bg-yellow-100 text-yellow-800',
            'review': 'bg-purple-100 text-purple-800',
            'done': 'bg-green-100 text-green-800'
        };

        const getInitials = (name) => {
            if (!name) return '?';
            return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
        };

        const getAvatarColor = (name) => {
            if (!name) return 'bg-gray-400';
            const colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-yellow-500'];
            const index = name.length % colors.length;
            return colors[index];
        };

        content.innerHTML = `
            <div class="space-y-6">
                <!-- Task Header -->
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">${this.escapeHtml(task.title)}</h2>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${priorityColors[task.priority] || 'bg-gray-100 text-gray-800'}">
                                <i class="fas fa-flag mr-1"></i>
                                ${task.priority}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${statusColors[task.status] || 'bg-gray-100 text-gray-800'}">
                                ${(task.status || '').replace('_', ' ')}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                ${task.description ? `
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Description</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">${this.escapeHtml(task.description || '')}</p>
                </div>
                ` : ''}

                <!-- Task Meta -->
                <div class="space-y-4">
                    <!-- Assignee -->
                    ${task.assignee ? `
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Assignee</h3>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 ${getAvatarColor(task.assignee || '')} rounded-full flex items-center justify-center text-white text-sm font-medium">
                                ${getInitials(task.assignee || '')}
                            </div>
                            <span class="text-sm text-gray-900">${this.escapeHtml(task.assignee || '')}</span>
                        </div>
                    </div>
                    ` : ''}

                    <!-- Story Points -->
                    ${task.story_points ? `
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Story Points</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-800 text-sm font-medium">
                            <i class="fas fa-chart-bar mr-1"></i>
                            ${task.story_points}
                        </span>
                    </div>
                    ` : ''}

                    <!-- Due Date -->
                    ${task.due_date ? `
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Due Date</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-100 text-gray-800 text-sm font-medium">
                            <i class="fas fa-calendar mr-1"></i>
                            ${task.due_date ? new Date(task.due_date).toLocaleDateString() : ''}
                        </span>
                    </div>
                    ` : ''}

                    <!-- Tags -->
                    ${task.tags && Array.isArray(task.tags) && task.tags.length > 0 ? `
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            ${task.tags.map(tag => `
                                <span class="inline-flex items-center px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-medium">
                                    ${this.escapeHtml(tag || '')}
                                </span>
                            `).join('')}
                        </div>
                    </div>
                    ` : ''}
                </div>

                <!-- Notes Section -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-700">Notes</h3>
                        <button onclick="kanbanBoard.addTaskNote(${task.id})" class="text-primary hover:text-primary/80 text-sm font-medium">
                            <i class="fas fa-plus mr-1"></i>
                            Add Note
                        </button>
                    </div>
                    <div id="task-notes-${task.id}" class="space-y-3">
                        ${task.notes_list && task.notes_list.length > 0 ? 
                            task.notes_list.map(note => `
                                <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                    <p class="text-sm text-gray-900 mb-2">${this.escapeHtml(note.body)}</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <i class="fas fa-user mr-1"></i>
                                        <span>${this.escapeHtml(note.user_name)}</span>
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>${note.created_at}</span>
                                    </div>
                                </div>
                            `).join('') : 
                            '<p class="text-gray-500 text-sm">No notes yet.</p>'
                        }
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-gray-200">
                    <div class="flex space-x-3">
                        <button onclick="kanbanBoard.editTask(${task.id})" class="flex-1 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Task
                        </button>
                        <button onclick="kanbanBoard.deleteTask(${task.id})" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                            <i class="fas fa-trash mr-2"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    addTaskNote(taskId) {
        // Create a nice modal for adding notes
        const addNoteModalHTML = `
            <div id="add-note-modal" class="fixed inset-0 bg-black/30 z-50">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Add Note</h3>
                            <button onclick="document.getElementById('add-note-modal').remove()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <!-- Modal Body -->
                        <form id="add-note-form" class="p-6">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Note</label>
                                <textarea id="note-text" rows="4" required
                                          class="w-full px-4 py-3 outline-none rounded-lg bg-white border border-primary/30 resize-none"
                                          placeholder="Enter your note here..."></textarea>
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class="flex space-x-3">
                                <button type="button" onclick="document.getElementById('add-note-modal').remove()" 
                                        class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="flex-1 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                                    Add Note
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', addNoteModalHTML);
        
        // Setup form submission
        document.getElementById('add-note-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const noteText = document.getElementById('note-text').value.trim();
            if (!noteText) return;
            
            try {
                // Save note via API
                const response = await fetch('/admin/api/notes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        entity_type: 'App\\Models\\Task',
                        entity_id: taskId,
                        body: noteText
                    })
                });
                
                if (response.ok) {
                    const result = await response.json();
                    
                    // Add note to the display
                    const notesContainer = document.getElementById(`task-notes-${taskId}`);
                    const noteElement = document.createElement('div');
                    noteElement.className = 'bg-gray-50 rounded-lg p-3 border border-gray-200';
                    noteElement.innerHTML = `
                        <p class="text-sm text-gray-900 mb-2">${this.escapeHtml(noteText)}</p>
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="fas fa-user mr-1"></i>
                            <span>${result.data.user_name}</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-clock mr-1"></i>
                            <span>${result.data.created_at}</span>
                        </div>
                    `;
                    // Remove "No notes yet" message if it exists
                    const noNotesMessage = notesContainer.querySelector('p.text-gray-500');
                    if (noNotesMessage) {
                        noNotesMessage.remove();
                    }
                    
                    notesContainer.appendChild(noteElement);
                    
                    // Update task data
                    const task = this.tasks.find(t => t.id === taskId);
                    if (task) {
                        // Initialize notes_list if it doesn't exist
                        if (!task.notes_list) {
                            task.notes_list = [];
                        }
                        
                        // Add new note to the notes_list array
                        task.notes_list.push({
                            id: result.data.id,
                            body: noteText,
                            user_name: result.data.user_name,
                            created_at: result.data.created_at
                        });
                        
                        // Update the single notes field as well
                        task.notes = noteText;
                    }
                    
                    // Close modal
                    document.getElementById('add-note-modal').remove();
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Note added successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error('Failed to save note');
                }
            } catch (error) {
                console.error('Error adding note:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to add note. Please try again.',
                });
            }
        });
        
        // Focus on textarea
        setTimeout(() => {
            document.getElementById('note-text').focus();
        }, 100);
    }
}

// Global variable for Kanban Board
let kanbanBoard;

// Initialize Kanban Board when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing Kanban Board...');
    
    // Wait a bit more to ensure all elements are rendered
    setTimeout(() => {
        try {
            kanbanBoard = new KanbanBoard();
            console.log('Kanban Board initialized successfully');
            
            // Add panel close event listeners
            document.getElementById('close-task-panel').addEventListener('click', () => {
                kanbanBoard.closeTaskDetail();
            });
            
            document.getElementById('task-panel-overlay').addEventListener('click', () => {
                kanbanBoard.closeTaskDetail();
            });
            
            // Close panel on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const panel = document.getElementById('task-detail-panel');
                    if (!panel.classList.contains('translate-x-full')) {
                        kanbanBoard.closeTaskDetail();
                    }
                }
            });
            
        } catch (error) {
            console.error('Error initializing Kanban Board:', error);
        }
    }, 100);
});
</script>
@endpush