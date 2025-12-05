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
                    <p class="text-textMuted text-sm mb-4">{{ $user->bio ?? 'No bio yet.' }}</p>

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
                            <span class="block text-white font-bold text-lg">{{ $user->followers()->count() }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Followers</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $user->following()->count() }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Following</span>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile -->
                @auth
                    @if (auth()->id() === $user->id)
                        <div class="mb-2">
                            <button onclick="openEditProfileModal()" class="px-4 py-1.5 rounded border border-gray-600 text-textMuted text-xs font-bold hover:text-white hover:border-white transition-colors uppercase tracking-wider">
                                Edit Profile
                            </button>
                        </div>
                    @endif
                @endauth

            </div>
        </div>
    </div>

    @include('profile._tabs')

    <!-- Content -->
    <div class="max-w-5xl mx-auto px-6 py-8">

        <!-- Example Content Grid -->
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2">
    
            <!-- Movie Item -->
           @foreach($liked as $watch)
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

</div>

@endsection
@include('profile._edit_profile_modal')