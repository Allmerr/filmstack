@extends('layouts.admin')
@section('content')


<div class="flex min-h-screen bg-dark fade-in">
              <!-- Sidebar -->
              <aside class="w-64 bg-[#1f252b] border-r border-gray-800 flex flex-col fixed h-full z-40">
                 <div class="p-6 border-b border-gray-800">
                   <div class="flex items-center gap-3 text-white font-bold text-xl">
                      <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-dark font-extrabold text-sm">CL</div>
                      <span>Admin Panel</span>
                   </div>
                 </div>
                 <nav class="flex-grow p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="w-full text-left px-4 py-3 rounded bg-primary/10 text-primary border border-primary/20 font-bold transition-all flex items-center gap-3 no-underline">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                       Dashboard
                    </a>
                    <a href="{{ route('admin.users') }}" class="w-full text-left px-4 py-3 rounded text-textMuted hover:bg-white/5 hover:text-white transition-all flex items-center gap-3 no-underline">
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

                  <header class="mb-8">
                      <h2 class="text-3xl font-bold text-white mb-1">Dashboard</h2>
                      <p class="text-textMuted text-sm">Manage your Filmstack application data.</p>
                  </header>
                  
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Stat Card 1 -->
                    <div class="bg-[#1f252b] p-6 rounded-lg border border-white/5 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-textMuted text-sm font-bold uppercase tracking-widest">Total Users</h3>
                            <div class="p-2 bg-primary/10 rounded text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-white">{{ $stats['total_users'] }}</p>
                        <p class="text-xs text-textMuted mt-2">+{{ $stats['new_users_week'] }} this week</p>
                    </div>
                    <!-- Stat Card 2 -->
                     <div class="bg-[#1f252b] p-6 rounded-lg border border-white/5 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-textMuted text-sm font-bold uppercase tracking-widest">Total Playlists</h3>
                            <div class="p-2 bg-blue-500/10 rounded text-blue-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-white">{{ $stats['total_playlists'] }}</p>
                        <p class="text-xs text-textMuted mt-2">Created by users</p>
                    </div>
                    <!-- Stat Card 3 -->
                     <div class="bg-[#1f252b] p-6 rounded-lg border border-white/5 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-textMuted text-sm font-bold uppercase tracking-widest">Total Reviews</h3>
                            <div class="p-2 bg-purple-500/10 rounded text-purple-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-white">{{ $stats['total_reviews'] }}</p>
                        <p class="text-xs text-textMuted mt-2">{{ $stats['total_admins'] }} admins</p>
                    </div>
                 </div>
                 
                 <!-- Recent Users -->
                 <div class="bg-[#1f252b] rounded-lg border border-white/5 p-6 mb-6">
                    <h3 class="text-white font-bold mb-4">Recent Users</h3>
                    <div class="space-y-3">
                        @forelse($recent_users as $user)
                        <div class="flex items-center justify-between p-3 bg-dark rounded border border-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-dark text-sm font-bold">
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-white font-semibold">{{ $user->username }}</p>
                                    <p class="text-textMuted text-xs">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-textMuted text-xs">{{ $user->created_at->diffForHumans() }}</p>
                                @if($user->is_admin)
                                    <span class="inline-block px-2 py-1 bg-primary/10 text-primary text-xs rounded font-bold">Admin</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-textMuted text-sm">No users yet.</p>
                        @endforelse
                    </div>
                 </div>

                 <!-- Recent Playlists -->
                 <div class="bg-[#1f252b] rounded-lg border border-white/5 p-6">
                    <h3 class="text-white font-bold mb-4">Recent Playlists</h3>
                    <div class="space-y-3">
                        @forelse($recent_playlists as $playlist)
                        <div class="flex items-center justify-between p-3 bg-dark rounded border border-white/5">
                            <div>
                                <p class="text-white font-semibold">{{ $playlist->name }}</p>
                                <p class="text-textMuted text-xs">by {{ $playlist->user->username ?? 'Unknown' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-textMuted text-xs">{{ $playlist->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-textMuted text-sm">No playlists yet.</p>
                        @endforelse
                    </div>
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