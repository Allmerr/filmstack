@extends('layouts.admin')
@section('content')


<div class="flex min-h-screen bg-dark fade-in">
              <!-- Sidebar -->
              <aside class="w-64 bg-[#1f252b] border-r border-gray-800 flex flex-col fixed h-full z-40">
                 <div class="p-6 border-b border-gray-800">
                   <div class="flex items-center gap-3 text-white font-bold text-xl">
                      <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-dark font-extrabold text-sm">FS</div>
                      <span>Admin Panel</span>
                   </div>
                 </div>
                 <nav class="flex-grow p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="w-full text-left px-4 py-3 rounded text-textMuted hover:bg-white/5 hover:text-white transition-all flex items-center gap-3 no-underline">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                       Dashboard
                    </a>
                    <a href="{{ route('admin.users') }}" class="w-full text-left px-4 py-3 rounded bg-primary/10 text-primary border border-primary/20 font-bold transition-all flex items-center gap-3 no-underline">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                       Users
                    </a>
                 </nav>
                 <div class="p-4 border-t border-gray-800">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded text-red-400 hover:bg-red-900/20 transition-colors flex items-center gap-2 font-bold text-sm">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                           Logout
                        </button>
                    </form>
                 </div>
              </aside>

              <!-- Main Content -->
              <main class="flex-grow ml-64 p-8 md:p-12">
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

                  <header class="mb-8 flex items-center justify-between">
                      <div>
                          <h2 class="text-3xl font-bold text-white mb-1">Users</h2>
                          <p class="text-textMuted text-sm">Manage users and permissions.</p>
                      </div>
                      <a href="{{ route('home') }}" class="px-4 py-2 bg-dark border border-gray-700 rounded text-textMuted hover:text-white hover:border-white transition-colors text-sm font-semibold">
                          Back to Site
                      </a>
                  </header>

                  <!-- Search & Filter -->
                  <form method="GET" action="{{ route('admin.users') }}" class="mb-6 flex gap-3">
                      <input 
                          type="text" 
                          name="search" 
                          placeholder="Search by username or email..." 
                          value="{{ request('search') }}"
                          class="flex-1 px-4 py-2 bg-[#1f252b] border border-gray-700 rounded text-white placeholder-textMuted focus:border-primary focus:outline-none"
                      >
                      <select name="filter" class="px-4 py-2 bg-[#1f252b] border border-gray-700 rounded text-white focus:border-primary focus:outline-none">
                          <option value="">All Users</option>
                          <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Admins Only</option>
                          <option value="regular" {{ request('filter') == 'regular' ? 'selected' : '' }}>Regular Users</option>
                      </select>
                      <button type="submit" class="px-6 py-2 bg-primary hover:bg-primaryHover text-dark font-bold rounded transition-colors">
                          Search
                      </button>
                  </form>

                   <div class="bg-[#1f252b] rounded-lg border border-white/5 overflow-hidden">
                    <div class="p-4 border-b border-gray-800">
                        <h3 class="font-bold text-white">Registered Users ({{ $users->total() }})</h3>
                    </div>
                     <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-[#14181c] text-xs font-bold text-textMuted uppercase tracking-wider">
                                <tr>
                                    <th class="p-4 border-b border-gray-800">User</th>
                                    <th class="p-4 border-b border-gray-800">Stats</th>
                                    <th class="p-4 border-b border-gray-800">Role</th>
                                    <th class="p-4 border-b border-gray-800">Joined</th>
                                    <th class="p-4 border-b border-gray-800 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($users as $user)
                                    <tr class="hover:bg-white/5 transition-colors border-b border-gray-800/50">
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
                                        <td class="p-4">
                                            <div class="text-textMuted text-xs">
                                                <div>{{ $user->playlists_count ?? 0 }} playlists</div>
                                                <div>{{ $user->reviews_count ?? 0 }} reviews</div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 rounded text-xs font-bold {{ $user->is_admin ? 'bg-primary/20 text-primary border border-primary/30' : 'bg-gray-700 text-gray-300' }}">
                                                {{ $user->is_admin ? 'Admin' : 'User' }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <div class="text-textMuted text-xs">{{ $user->created_at->format('M d, Y') }}</div>
                                            <div class="text-textMuted text-xs opacity-60">{{ $user->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="p-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 text-xs font-bold rounded {{ $user->is_admin ? 'bg-yellow-900/20 text-yellow-400 hover:bg-yellow-900/30' : 'bg-green-900/20 text-green-400 hover:bg-green-900/30' }} transition-colors">
                                                        {{ $user->is_admin ? 'Revoke Admin' : 'Make Admin' }}
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete {{ $user->username }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-textMuted hover:text-red-400 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-textMuted">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($users->hasPages())
                        <div class="p-4 border-t border-gray-800">
                            {{ $users->links() }}
                        </div>
                    @endif
                  </div>
              </main>

              <!-- ADD MOVIE MODAL -->
              <div id="add-movie-modal" class="fixed inset-0 z-[80] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
                  <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeAddMovieModal()"></div>
                  <div class="bg-[#1f252b] w-full max-w-2xl rounded-xl shadow-2xl border border-white/10 relative transform scale-95 transition-all duration-300 z-10 overflow-hidden max-h-[90vh] overflow-y-auto custom-scrollbar">
                      <div class="p-6">
                        <h3 class="text-white font-bold text-xl mb-6">Add New Movie</h3>
                        <form onsubmit="saveNewMovie(event)" class="space-y-4">
                           <div class="grid grid-cols-2 gap-4">
                              <div>
                                 <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Title</label>
                                 <input id="new-movie-title" type="text" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" required>
                              </div>
                              <div>
                                 <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Year</label>
                                 <input id="new-movie-year" type="text" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" required>
                              </div>
                           </div>
                           <div class="grid grid-cols-2 gap-4">
                              <div>
                                 <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Rating</label>
                                 <input id="new-movie-rating" type="number" step="0.1" max="5" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" required>
                              </div>
                              <div>
                                 <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Runtime</label>
                                 <input id="new-movie-runtime" type="text" placeholder="e.g. 120 min" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none">
                              </div>
                           </div>
                           <div>
                               <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Poster Image URL</label>
                               <input id="new-movie-img" type="text" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" required>
                           </div>
                           <div>
                               <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Backdrop Image URL</label>
                               <input id="new-movie-backdrop" type="text" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none">
                           </div>
                           <div>
                               <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Plot Summary</label>
                               <textarea id="new-movie-plot" rows="3" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none"></textarea>
                           </div>
                           
                           <div class="flex justify-end gap-3 pt-4 border-t border-white/5 mt-6">
                              <button type="button" onclick="closeAddMovieModal()" class="px-4 py-2 rounded text-textMuted hover:text-white transition-colors font-bold text-sm">Cancel</button>
                              <button type="submit" class="bg-primary hover:bg-white text-darker font-bold py-2 px-6 rounded text-sm transition-colors">Add Movie</button>
                           </div>
                        </form>
                      </div>
                  </div>
              </div>
            </div>

@endsection