@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    {{-- Users Management Section --}}
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Users</h2>
                <p class="text-gray-600">Manage user accounts and permissions</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Add New User Button --}}
                <a href="{{ route('admin.access.users.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-plus text-white"></i>
                    <span>New User</span>
                </a>
            </div>
        </div>
        {{-- Users Table --}}
        <div class="p-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="usersTable" class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>NAME</span>
                                <i class="fa-solid fa-sort text-gray-500 text-xs"></i>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>EMAIL</span>
                                <i class="fa-solid fa-sort text-gray-500 text-xs"></i>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>ROLES</span>
                                <i class="fa-solid fa-sort text-gray-500 text-xs"></i>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>STATUS</span>
                                <i class="fa-solid fa-sort text-gray-500 text-xs"></i>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>CREATED</span>
                                <i class="fa-solid fa-sort text-gray-500 text-xs"></i>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <span>ACTIONS</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 group-hover:text-gray-700 transition-colors">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm text-gray-600 group-hover:text-gray-700 transition-colors">{{ $user->email }}</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($user->roles as $role)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $role->name }}
                                                </span>
                                    @empty
                                        <span class="text-sm text-gray-500">No roles assigned</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" {{ $user->is_active ?? true ? 'checked' : '' }} onclick="toggleUserStatus({{ $user->id }}, this)">
                                        <div class="w-12 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary transition-all duration-200"></div>
                                    </label>
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm text-gray-600 group-hover:text-gray-700 transition-colors">{{ $user->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.access.users.show', $user->id) }}" class="text-blue-500 hover:text-blue-700 transition-colors p-2 rounded-lg hover:bg-blue-50" title="View">
                                        <i class="fa-solid fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('admin.access.users.edit', $user->id) }}" class="text-primary hover:text-primary/80 transition-colors p-2 rounded-lg hover:bg-primary/10" title="Edit">
                                        <i class="fa-solid fa-pen text-lg"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <button class="text-red-500 hover:text-red-700 transition-colors p-2 rounded-lg hover:bg-red-50" title="Delete" onclick="deleteUser({{ $user->id }})">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-3">
                                    <i class="fa-solid fa-users text-4xl text-gray-300"></i>
                                    <span class="text-lg font-medium">No users found.</span>
                                    <span class="text-sm text-gray-400">Create your first user to get started.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script>
        // Initialize DataTables
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Check if table exists
                const table = document.getElementById('usersTable');
                if (!table) {
                    console.error('Users table not found');
                    return;
                }

                // Check if table has data rows (excluding empty state row)
                const tbody = table.querySelector('tbody');
                const dataRows = tbody ? Array.from(tbody.children).filter(row =>
                    !row.querySelector('td[colspan="6"]') // Exclude empty state row
                ) : [];

                // Only initialize DataTable if we have actual data rows
                if (dataRows.length === 0) {
                    console.log('No users data found, skipping DataTable initialization');
                    return;
                }

                console.log(`Initializing DataTable with ${dataRows.length} user rows`);

                // DataTables 2.x - Modern and simple initialization
                const usersTable = new DataTable('#usersTable', {
                    responsive: true,
                    processing: true,
                    pageLength: 10,
                    order: [[0, 'asc']], // Sort by name by default
                    // DOM structure: l=length, f=filter(search), r=processing, t=table, i=info, p=pagination
                    dom: '<"flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6"lf>rt<"flex flex-col lg:flex-row justify-between items-start lg:items-center mt-6"ip>',
                    language: {
                        search: "Zoeken:",
                        lengthMenu: "Toon _MENU_ items per pagina",
                        info: "Toont _START_ tot _END_ van _TOTAL_ items",
                        infoEmpty: "Toont 0 tot 0 van 0 items",
                        infoFiltered: "(gefilterd van _MAX_ totale items)",
                        emptyTable: "Geen gebruikers gevonden",
                        zeroRecords: "Geen overeenkomende gebruikers gevonden",
                        paginate: {
                            first: "Eerste",
                            previous: "Vorige",
                            next: "Volgende",
                            last: "Laatste"
                        }
                    },
                    initComplete: function() {
                        // Custom styling for DataTable elements
                        this.api().tables().every(function() {
                            const table = this.node();

                            // Style the search box
                            const searchBox = table.parentNode.querySelector('.dataTables_filter input');
                            if (searchBox) {
                                searchBox.className = 'px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary ml-2';
                                searchBox.placeholder = 'Zoeken...';
                            }

                            // Style the length selector
                            const lengthSelect = table.parentNode.querySelector('.dataTables_length select');
                            if (lengthSelect) {
                                lengthSelect.className = 'px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary ml-2';
                            }

                            // Style the info text
                            const infoText = table.parentNode.querySelector('.dataTables_info');
                            if (infoText) {
                                infoText.className = 'text-sm text-gray-600 mt-4 lg:mt-0';
                            }

                            // Style the pagination
                            const pagination = table.parentNode.querySelector('.dataTables_paginate');
                            if (pagination) {
                                pagination.className = 'flex flex-col lg:flex-row justify-between items-start lg:items-center mt-6';

                                // Style pagination buttons
                                const paginationButtons = pagination.querySelectorAll('a, span');
                                paginationButtons.forEach(button => {
                                    if (button.tagName === 'A') {
                                        button.className = 'px-3 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors';
                                    } else if (button.tagName === 'SPAN') {
                                        button.className = 'px-3 py-2 text-sm bg-primary text-white rounded-lg';
                                    }
                                });
                            }
                        });
                    }
                });
            } catch (error) {
                console.error('Error initializing DataTable:', error);
                console.log('DataTable initialization failed, table will remain as basic HTML');
            }
        });

        // Toggle user status
        function toggleUserStatus(userId, checkbox) {
            // Show loading state
            checkbox.disabled = true;

            // Make AJAX call to toggle status
            axios.patch(`/system/access/users/${userId}/toggle-status`, {}, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (response.data.success) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'User status updated successfully!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // Update checkbox state based on response
                        checkbox.checked = response.data.is_active;

                        try {
                            // Update the toggle switch visual state by recreating it
                            const toggleContainer = checkbox.closest('label');
                            if (toggleContainer) {
                                if (response.data.is_active) {
                                    // Active state - blue background
                                    toggleContainer.innerHTML = `
                                <input type="checkbox" class="sr-only peer" checked onclick="toggleUserStatus(${userId}, this)">
                                <div class="w-12 h-7 bg-primary peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all transition-all duration-200"></div>
                            `;
                                } else {
                                    // Inactive state - gray background
                                    toggleContainer.innerHTML = `
                                <input type="checkbox" class="sr-only peer" onclick="toggleUserStatus(${userId}, this)">
                                <div class="w-12 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all transition-all duration-200"></div>
                            `;
                                }
                            }
                        } catch (error) {
                            console.error('Error updating UI after toggle:', error);
                            // If UI update fails, just reload the page to ensure consistency
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error toggling user status:', error);

                    // Show error message
                    Swal.fire({
                        title: 'Error!',
                        text: error.response?.data?.message || 'Failed to update user status. Please try again.',
                        icon: 'error'
                    });

                    // Don't change checkbox state on error - keep it as it was
                })
                .finally(() => {
                    // Re-enable checkbox
                    checkbox.disabled = false;
                });
        }

        // Delete user function
        function deleteUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX call to delete the user
                    axios.delete(`/system/access/users/${userId}`)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload the page to refresh the table
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            console.error('Error deleting user:', error);
                            Swal.fire(
                                'Error!',
                                error.response?.data?.message || 'Failed to delete user. Please try again.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>
@endpush