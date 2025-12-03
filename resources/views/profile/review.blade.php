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
                <a href="{{ route('profile.watched', ['username' => $user->username]) }}">Watched</a> <span class="text-xs text-gray-600 ml-1">{{ $watched->count() }}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.liked', ['username' => $user->username]) }}">Likes</a> <span class="text-xs text-gray-600 ml-1">{{$liked->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-primary text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.reviews', ['username' => $user->username]) }}">Reviews</a> <span class="text-xs text-gray-600 ml-1">{{$reviews->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                <a href="{{ route('profile.watchlist', ['username' => $user->username]) }}">Watchlist</a> <span class="text-xs text-gray-600 ml-1">{{$watchlist->count()}}</span>
            </button>
            <button class="py-4 border-b-2 border-transparent text-textMuted hover:text-white transition-colors whitespace-nowrap">
                Lists
            </button>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-5xl mx-auto px-6 py-8">

        <!-- Example Content Grid -->
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2">
    
            <!-- Movie Item -->
            @foreach($reviews as $watch)
            <a href="{{ url('/film/'.$watch->movie['id']) }}" class="relative group cursor-pointer block">
                <div class="relative pb-[150%] rounded overflow-hidden border border-white/10 hover:border-primary transition-colors">
                    <img src="{{ $watch->movie['primaryImage']['url'] }}" class="absolute inset-0 w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                        <span class="text-white font-bold text-sm text-center px-1">{{ $watch->rated->rating ?? 'Not Rated' }} ★</span>
                    </div>
                </div>
            </a>
            @endforeach

            <!-- Tambahkan item lain disini -->

        </div>

    </div>

</div>

@endsection