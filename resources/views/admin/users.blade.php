@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen bg-dark fade-in">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#1f252b] border-r border-gray-800 flex flex-col fixed h-full z-40">
        <!-- Header -->
        <div class="p-6 border-b border-gray-800">
            <div class="flex items-center gap-3 text-white font-bold text-xl">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-dark font-extrabold text-sm">FS</div>
                <span>Admin Panel</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-grow p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="w-full text-left px-4 py-3 rounded text-textMuted hover:bg-white/5 hover:text-white transition-all flex items-center gap-3 no-underline">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="w-full text-left px-4 py-3 rounded bg-primary/10 text-primary border border-primary/20 font-bold transition-all flex items-center gap-3 no-underline">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Users
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 rounded text-red-400 hover:bg-red-900/20 transition-colors flex items-center gap-2 font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow ml-64 p-8 md:p-12">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-900/20 border border-green-500/30 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded bg-red-900/20 border border-red-500/30 text-red-400">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <header class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-white mb-1">Users</h2>
                <p class="text-textMuted text-sm">Manage users and permissions.</p>
            </div>
            <a href="{{ route('welcome') }}" class="px-4 py-2 bg-dark border border-gray-700 rounded text-textMuted hover:text-white hover:border-white transition-colors text-sm font-semibold">
                Back to Site
            </a>
        </header>

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('admin.users') }}" class="mb-6 flex gap-3">
            <input 
                type="text" 
                name="search" 
                placeholder="Search by username or email..." 
                value="{{ request('search') }}"
                class="flex-1 px-4 py-2 bg-[#1f252b] border border-gray-700 rounded text-white placeholder-textMuted focus:border-primary focus:outline-none"
            >
            <button type="submit" class="px-6 py-2 bg-primary hover:bg-primaryHover text-dark font-bold rounded transition-colors">
                Search
            </button>
        </form>

        <!-- Users Table -->
        <div class="bg-[#1f252b] rounded-lg border border-white/5 overflow-hidden">
            <div class="p-4 border-b border-gray-800">
                <h3 class="font-bold text-white">Registered Users ({{ $users->count() }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table id="usersTable" class="w-full text-left border-collapse table table-striped table-dark" style="width: 100%;">
                    <thead class="bg-[#14181c] text-xs font-bold text-textMuted uppercase tracking-wider">
                        <tr>
                            <th class="p-4 border-b border-gray-800">User</th>
                            <th class="p-4 border-b border-gray-800">Playlists</th>
                            <th class="p-4 border-b border-gray-800">Reviews</th>
                            <th class="p-4 border-b border-gray-800">Role</th>
                            <th class="p-4 border-b border-gray-800">Joined</th>
                            <th class="p-4 border-b border-gray-800 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($users as $user)
                            <tr class="hover:bg-white/5 transition-colors border-b border-gray-800/50">
                                <!-- User Info -->
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-dark font-bold text-sm">
                                            {{ strtoupper(substr($user->username, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white">{{ $user->username }}</div>
                                            <div class="text-xs text-textMuted">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Playlists Count -->
                                <td class="p-4">
                                    <div class="text-textMuted text-xs">{{ $user->playlists_count ?? 0 }}</div>
                                </td>

                                <!-- Reviews Count -->
                                <td class="p-4">
                                    <div class="text-textMuted text-xs">{{ $user->reviews_count ?? 0 }}</div>
                                </td>

                                <!-- Role Badge -->
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $user->is_admin ? 'bg-primary/20 text-primary border border-primary/30' : 'bg-gray-700 text-gray-300' }}">
                                        {{ $user->is_admin ? 'Admin' : 'User' }}
                                    </span>
                                </td>

                                <!-- Joined Date -->
                                <td class="p-4">
                                    <div class="text-textMuted text-xs">{{ $user->created_at->format('M d, Y') }}</div>
                                    <div class="text-textMuted text-xs opacity-60">{{ $user->created_at->diffForHumans() }}</div>
                                </td>

                                <!-- Actions -->
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Make/Revoke Admin -->
                                        <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-xs font-bold rounded {{ $user->is_admin ? 'bg-yellow-900/20 text-yellow-400 hover:bg-yellow-900/30' : 'bg-green-900/20 text-green-400 hover:bg-green-900/30' }} transition-colors">
                                                {{ $user->is_admin ? 'Revoke Admin' : 'Make Admin' }}
                                            </button>
                                        </form>

                                        <!-- Delete User -->
                                        <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete {{ $user->username }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-textMuted hover:text-red-400 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-textMuted">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@push('scripts')
<style>
    /* DataTable Styling */
    .dt-buttons {
        margin-bottom: 1rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .dt-button {
        padding: 0.5rem 1rem !important;
        border-radius: 0.375rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
        border: none !important;
        cursor: pointer !important;
        background-color: #00e054 !important;
        color: #14181c !important;
    }

    .dt-button:not(.disabled):hover {
        background-color: #00b042 !important;
    }

    .dt-button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #00e054 !important;
        color: #14181c !important;
        border: none !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        background-color: #1f252b !important;
        border: 1px solid #444 !important;
        color: white !important;
        padding: 0.375rem 0.75rem !important;
        border-radius: 0.375rem !important;
    }

    .dataTables_wrapper .dataTables_length select {
        background-color: #1f252b !important;
        border: 1px solid #444 !important;
        color: white !important;
        padding: 0.375rem 0.75rem !important;
        border-radius: 0.375rem !important;
    }

    .dataTables_wrapper .dataTables_info {
        color: #99aabb;
    }
</style>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            dom: 'Bflrtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: '📥 Export PDF',
                    className: 'dt-button',
                    title: 'Users Report - Filmstack',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 10;
                        doc.content[1].table.widths = ['20%', '10%', '10%', '10%', '15%', '35%'];
                        doc.content[1].table.body.forEach(function(row, i) {
                            if (i === 0) {
                                row.forEach(function(cell) {
                                    cell.fillColor = '#00e054';
                                    cell.textColor = '#14181c';
                                    cell.fontSize = 11;
                                    cell.bold = true;
                                    cell.alignment = 'center';
                                });
                            }
                        });
                        doc.pageMargins = [20, 20, 20, 20];
                        doc.styles.tableBodyEven.fillColor = '#f5f5f5';
                    }
                },
                {
                    extend: 'excel',
                    text: '📊 Export Excel',
                    className: 'dt-button',
                    title: 'Users Report'
                },
                {
                    extend: 'print',
                    text: '🖨️ Print',
                    className: 'dt-button'
                }
            ],
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                search: 'Filter:',
                searchPlaceholder: 'Search users...',
                lengthMenu: 'Show _MENU_ entries',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                paginate: {
                    first: 'First',
                    last: 'Last',
                    next: 'Next',
                    previous: 'Previous'
                }
            },
            order: [[4, 'desc']]
        });
    });
</script>
@endpush

@endsection
            </div>



@push('scripts')
<style>
    .dt-buttons {
        margin-bottom: 1rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .dt-button {
        padding: 0.5rem 1rem !important;
        border-radius: 0.375rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
        border: none !important;
        cursor: pointer !important;
        background-color: #00e054 !important;
        color: #14181c !important;
    }
    .dt-button:not(.disabled):hover {
        background-color: #00b042 !important;
    }
    .dt-button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #00e054 !important;
        color: #14181c !important;
        border: none !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        background-color: #1f252b !important;
        border: 1px solid #444 !important;
        color: white !important;
        padding: 0.375rem 0.75rem !important;
        border-radius: 0.375rem !important;
    }
    .dataTables_wrapper .dataTables_length select {
        background-color: #1f252b !important;
        border: 1px solid #444 !important;
        color: white !important;
        padding: 0.375rem 0.75rem !important;
        border-radius: 0.375rem !important;
    }
    .dataTables_wrapper .dataTables_info {
        color: #99aabb;
    }
</style>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            dom: 'Bflrtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: '📥 Export PDF',
                    className: 'dt-button',
                    title: 'Users Report - Filmstack',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 10;
                        doc.content[1].table.widths = ['20%', '10%', '10%', '10%', '15%', '35%'];
                        doc.content[1].table.body.forEach(function(row, i) {
                            if (i === 0) {
                                row.forEach(function(cell) {
                                    cell.fillColor = '#00e054';
                                    cell.textColor = '#14181c';
                                    cell.fontSize = 11;
                                    cell.bold = true;
                                    cell.alignment = 'center';
                                });
                            }
                        });
                        doc.pageMargins = [20, 20, 20, 20];
                        doc.styles.tableBodyEven.fillColor = '#f5f5f5';
                    }
                },
                {
                    extend: 'excel',
                    text: '📊 Export Excel',
                    className: 'dt-button',
                    title: 'Users Report'
                },
                {
                    extend: 'print',
                    text: '🖨️ Print',
                    className: 'dt-button'
                }
            ],
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
                {
                    targets: -1, // Last column (Actions)
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                search: 'Filter:',
                searchPlaceholder: 'Search users...',
                lengthMenu: 'Show _MENU_ entries',
            },
            order: [[4, 'desc']] // Sort by Joined date descending
        });
    });
</script>
@endpush
