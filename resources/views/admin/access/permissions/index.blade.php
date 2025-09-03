@extends('layouts.admin')

@section('title', 'Permissions')

@section('content')
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Permissions</h2>
                <p class="text-gray-600">Manage system permissions and access rights</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Add New Permission Button --}}
                <a href="{{ route('admin.access.permissions.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-plus text-white"></i>
                    <span>New Permission</span>
                </a>
            </div>
        </div>

        {{-- Permissions Table --}}
        <div class="p-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="permissionsTable" class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>PERMISSION NAME</span>
                                <i class="fa-solid fa-sort text-gray-500 text-xs"></i>
                            </div>
                        </th>
                        <th class="px-8 py-5 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>GUARD</span>
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
                    @forelse($permissions as $permission)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 group-hover:text-gray-700 transition-colors">{{ $permission->name }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $permission->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $permission->guard_name }}
                            </span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($permission->roles->take(3) as $role)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $role->name }}
                                    </span>
                                    @empty
                                        <span class="text-sm text-gray-500">No roles</span>
                                    @endforelse
                                    @if($permission->roles->count() > 3)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        +{{ $permission->roles->count() - 3 }} more
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm text-gray-600 group-hover:text-gray-700 transition-colors">{{ $permission->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.access.permissions.show', $permission->id) }}" class="text-blue-500 hover:text-blue-700 transition-colors p-2 rounded-lg hover:bg-blue-50" title="View">
                                        <i class="fa-solid fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('admin.access.permissions.edit', $permission->id) }}" class="text-primary hover:text-primary/80 transition-colors p-2 rounded-lg hover:bg-primary/10" title="Edit">
                                        <i class="fa-solid fa-pen text-lg"></i>
                                    </a>
                                    @if($permission->roles->count() === 0)
                                        <button class="text-red-500 hover:text-red-700 transition-colors p-2 rounded-lg hover:bg-red-50" title="Delete" onclick="deletePermission({{ $permission->id }})">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-3">
                                    <i class="fa-solid fa-key text-4xl text-gray-300"></i>
                                    <span class="text-lg font-medium">No permissions found.</span>
                                    <span class="text-sm text-gray-400">Create your first permission to get started.</span>
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
                const table = document.getElementById('permissionsTable');
                if (!table) {
                    console.error('Permissions table not found');
                    return;
                }

                // Check if table has data rows (excluding empty state row)
                const tbody = table.querySelector('tbody');
                const dataRows = tbody ? Array.from(tbody.children).filter(row =>
                    !row.querySelector('td[colspan="5"]') // Exclude empty state row
                ) : [];

                // Only initialize DataTable if we have actual data rows
                if (dataRows.length === 0) {
                    console.log('No permissions data found, skipping DataTable initialization');
                    return;
                }

                console.log(`Initializing DataTable with ${dataRows.length} permission rows`);

                // DataTables 2.x - Modern and simple initialization
                const permissionsTable = new DataTable('#permissionsTable', {
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
                        emptyTable: "Geen permissies gevonden",
                        zeroRecords: "Geen overeenkomende permissies gevonden",
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

        // Delete permission function
        function deletePermission(permissionId) {
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
                    // Make AJAX call to delete the permission
                    axios.delete(`/system/access/permissions/${permissionId}`)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Permission has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload the page to refresh the table
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            console.error('Error deleting permission:', error);
                            Swal.fire(
                                'Error!',
                                error.response?.data?.message || 'Failed to delete permission. Please try again.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>
@endpush
