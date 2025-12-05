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
                        <img src="{{ 'https://i.pravatar.cc/150?img=12'}}" class="w-full h-full object-cover" />
                    </div>
                </div>

                <!-- User Info -->
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-1">{{ $user->username }}</h1>
                    <p class="text-textMuted text-sm mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, veniam optio? Sint, nesciunt pariatur cum tempora neque molestiae quisquam ut quae animi! Dolore incidunt beatae expedita, provident repellat magni fugiat!</p>

                    <div class="flex justify-center md:justify-start gap-6 md:gap-10 text-sm">
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $watched->count() }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Films</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ 'watched' }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">This Year</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{'followers'}}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Followers</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{'following'}}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Following</span>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile -->
                <div class="mb-2">
                    <button class="px-4 py-1.5 rounded border border-gray-600 text-textMuted text-xs font-bold hover:text-white hover:border-white transition-colors uppercase tracking-wider">
                        Edit Profile
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-[#14181c] border-b border-gray-800 sticky top-[72px] z-40">
        <div class="max-w-5xl mx-auto px-6 flex gap-8 text-sm font-bold uppercase tracking-widest overflow-x-auto">
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.watched', ['username' => auth()->user()->username]) }}">Watched</a> <span class="text-xs text-gray-600 ml-1">{{ $watched->count() }}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.liked', ['username' => auth()->user()->username]) }}">Likes</a> <span class="text-xs text-gray-600 ml-1">{{$liked->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.reviews', ['username' => auth()->user()->username]) }}">Reviews</a> <span class="text-xs text-gray-600 ml-1">{{$reviews->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.watchlist', ['username' => auth()->user()->username]) }}">Watchlist</a> <span class="text-xs text-gray-600 ml-1">{{$watchlist->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-primary text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.playlists', ['username' => auth()->user()->username]) }}">Playlists</a> <span class="text-xs text-gray-600 ml-1">{{$playlists->count()}}</span>
            </button>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-5xl mx-auto px-6 py-8">

        <div class="max-w-5xl mx-auto px-6 py-8">
                    
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($playlists as $playlist)
                                 <a href="{{ route('playlists.show', $playlist->id) }}" class="bg-[#1f252b] rounded-lg p-4 border border-white/5 hover:border-primary transition-all group cursor-pointer block">
                            <div class="flex -space-x-4 mb-4 h-24 overflow-hidden relative">
                                @if($playlist->filmofplaylists->count() == 0)
                                   <div class="w-full h-24 bg-gray-800 rounded flex items-center justify-center text-textMuted text-xs">Empty</div>
                                @endif
                                @foreach($playlist->filmofplaylists->take(3) as $film)
                                  <img src="https://image.tmdb.org/t/p/w500{{ $film->poster_path }}" class="w-16 h-24 object-cover rounded shadow-lg border-2 border-[#1f252b] transform group-hover:scale-105 transition-transform z-10">
                                @endforeach
                            </div>
                            <h3 class="text-white font-bold text-lg group-hover:text-primary transition-colors">{{ $playlist->name }}</h3>
                            <p class="text-textMuted text-xs uppercase tracking-wider">{{ $playlist->filmofplaylists->count() }} Films</p>
                                 </a>
                    @endforeach

                  </div>
                
                </div>

        </div>

    </div>

</div>

@endsection