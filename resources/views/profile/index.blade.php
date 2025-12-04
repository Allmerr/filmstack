@extends('layouts.main')
@section('content')
<div class="fade-in min-h-screen pb-20">

    <!-- Profile Header -->
    <div class="relative bg-darker border-b border-gray-800">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[50%] left-[20%] w-[60%] h-[100%] bg-primary blur-[150px] opacity-5"></div>
        </div>

        <div class="max-w-5xl mx-auto px-6 py-10 md:py-14 relative z-10">
            <div class="flex flex-col md:flex-row items-center md:items-end gap-6 md:gap-8">

                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-[#1f252b] shadow-xl overflow-hidden">
                        <img src="{{ $user->avatar ? asset('storage/profile/' . $user->avatar) : 'https://i.pravatar.cc/150?img=12' }}" class="w-full h-full object-cover" />
                    </div>
                </div>

                <!-- User Info -->
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-1">{{ $user->username }}</h1>
                    <p class="text-textMuted text-sm mb-4">{{ $user->bio }}</p>
                    <div class="flex justify-center md:justify-start gap-6 md:gap-10 text-sm">
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $watched->count() }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Films</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $watched->count() }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">This Year</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $followers }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Followers</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $followers }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Following</span>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile -->
                @if(@auth()->check() && auth()->user()->id === $user->id)
                <div class="mb-2">
                    <button onclick="openEditProfileModal()"  class="px-4 py-1.5 rounded border border-gray-600 text-textMuted text-xs font-bold hover:text-white hover:border-white transition-colors uppercase tracking-wider">
                        Edit Profile
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Tabs -->
   <div class="bg-[#14181c] border-b border-gray-800 sticky top-[72px] z-40">
        <div class="max-w-5xl mx-auto px-6 flex gap-8 text-sm font-bold uppercase tracking-widest overflow-x-auto">
            <button class="py-4 border-b-2 border-primary text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.watched', ['username' => $user->username]) }}">Watched</a> <span class="text-xs text-gray-600 ml-1">{{ $watched->count() }}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.liked', ['username' => $user->username]) }}">Likes</a> <span class="text-xs text-gray-600 ml-1">{{$liked->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.reviews', ['username' => $user->username]) }}">Reviews</a> <span class="text-xs text-gray-600 ml-1">{{$reviews->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.watchlist', ['username' => $user->username]) }}">Watchlist</a> <span class="text-xs text-gray-600 ml-1">{{$watchlist->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.playlists', ['username' => $user->username]) }}">Playlists</a> <span class="text-xs text-gray-600 ml-1">{{$playlists->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.followers', ['username' => $user->username]) }}">Friends</a> <span class="text-xs text-gray-600 ml-1">{{$followers}}</span>
            </button>

        </div>
    </div>


    <!-- Content -->
    <div class="max-w-5xl mx-auto px-6 py-8">

        <!-- Example Content Grid -->
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2">

            <!-- Movie Item -->
            @foreach($watched as $watch)
            <a href="{{ url('/film/'.$watch->movie['id']) }}" class="relative group cursor-pointer block">
                <div class="relative pb-[150%] rounded overflow-hidden border border-white/10 hover:border-primary transition-colors">
                    <img src="https://image.tmdb.org/t/p/w500/{{ $watch->movie['poster_path'] }}" class="absolute inset-0 w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                        <span class="text-white font-bold text-sm text-center px-1">{{ $watch->rated->rating ?? 'Not Rated' }} ★</span>
                    </div>
                </div>
            </a>
            @endforeach

            <!-- Tambahkan item lain disini -->

        </div>

    </div>

    <div id="edit-profile-modal" class="fixed inset-0 z-[70] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
                    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditProfileModal()"></div>
                    <div class="bg-[#1f252b] w-full max-w-lg rounded-xl shadow-2xl border border-white/10 relative transform scale-95 transition-all duration-300 z-10 overflow-hidden">
                       <div class="p-6">
                          <h3 class="text-white font-bold text-xl mb-6">Edit Profile</h3>
                          <form onsubmit="" class="space-y-4" method="POST" action="{{ route('profile.update', ['username' => $user->username]) }}" enctype="multipart/form-data">
                            @csrf
                             <!-- Avatar -->
                             <div class="flex items-center gap-4">
                                <div class="relative group cursor-pointer" onclick="document.getElementById('edit-avatar-file').click()">
                                    <img id="edit-avatar-preview" src="" class="w-16 h-16 rounded-full object-cover border-2 border-white/10 group-hover:border-primary transition-colors" />   
                                    <div class="absolute inset-0 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 flex items-center justify-center text-xs text-white font-bold transition-opacity">
                                        Edit
                                    </div>
                                </div>
                                <div class="flex-grow">
                                   <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Avatar Image</label>
                                   <!-- File Input (Hidden) -->
                                   <input id="edit-avatar-file" type="file" accept="image/*" class="hidden" onchange="handleFileUpload(this)" name="avatar">
                                <button type="button" onclick="document.getElementById('edit-avatar-file').click()" class="text-xs text-primary hover:text-white font-bold uppercase tracking-wider flex items-center gap-1">
                                    <span id="edit-avatar-status" class="text-xs font-bold text-primary uppercase tracking-wider mr-2">No file chosen</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    Upload from device
                                </button>

                                <script>
                                function handleFileUpload(input) {
                                    const status = document.getElementById('edit-avatar-status');
                                    const preview = document.getElementById('edit-avatar-preview');

                                    if (!input.files || !input.files[0]) {
                                        status.textContent = 'No file chosen';
                                        preview.src = '';
                                        preview.classList.remove('border-primary');
                                        return;
                                    }

                                    const file = input.files[0];
                                    status.textContent = file.name;

                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.classList.add('border-primary');
                                    };
                                    reader.readAsDataURL(file);

                                    // Example: do something else when file chosen
                                    // e.g. enable submit button, set a hidden flag, or perform client-side validation
                                    // document.querySelector('button[type="submit"]').disabled = false;
                                }
                                </script>
                                </div>
                             </div>
                             <!-- Name -->
                             <div>
                                <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">{{ __('Username') }}</label>
                                <input id="edit-username" type="text" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" name="username" value="{{ $user->username }}" required>
                             </div>
                             <!-- Bio -->
                             <div>
                                <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">{{ __('Bio') }}</label>
                                <textarea id="edit-bio" rows="3" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" name="bio" >{{ $user->bio }}</textarea>
                             </div>
                             
                             <div class="flex justify-end gap-3 pt-4 border-t border-white/5 mt-6">
                                <button type="button" onclick="closeEditProfileModal()" class="px-4 py-2 rounded text-textMuted hover:text-white transition-colors font-bold text-sm">Cancel</button>
                                <button type="submit" class="bg-primary hover:bg-white text-darker font-bold py-2 px-6 rounded text-sm transition-colors">Save Changes</button>
                             </div>
                          </form>
                       </div>
                    </div>
                </div>
            </div>

</div>

@endsection
@push('js')
<script>
   
      function openEditProfileModal() {
          const modal = document.getElementById('edit-profile-modal');
          if (!modal) return;

            document.getElementById('edit-avatar-preview').src = "{{ $user->avatar ? asset('storage/profile/' . $user->avatar) : 'https://i.pravatar.cc/150?img=12' }}";
          // Show
          modal.classList.remove('opacity-0', 'pointer-events-none');
          const card = modal.querySelector('.transform');
          card.classList.remove('scale-95');
          card.classList.add('scale-100');
      }

      function closeEditProfileModal() {
          const modal = document.getElementById('edit-profile-modal');
          if (!modal) return;
          
          const card = modal.querySelector('.transform');
          card.classList.remove('scale-100');
          card.classList.add('scale-95');
          
          modal.classList.add('opacity-0', 'pointer-events-none');
      }

</script>
@endpush