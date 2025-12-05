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
                            <span class="block text-white font-bold text-lg">{{ $followers->count() }}</span>
                            <span class="text-textMuted uppercase text-[10px] tracking-widest">Followers</span>
                        </div>
                        <div class="text-center md:text-left">
                            <span class="block text-white font-bold text-lg">{{ $following->count() }}</span>
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

        <!-- Sub-navigation: Followers / Following -->
        <div class="flex gap-6 mb-6 border-b border-gray-800">
            <a href="{{ route('profile.followers', ['username' => $user->username]) }}" class="py-3 px-4 border-b-2 border-transparent text-textMuted hover:text-white font-bold text-sm uppercase tracking-wider transition-colors">
                Followers <span class="text-xs text-gray-500 ml-1">({{ $followers->count() }})</span>
            </a>
            <a href="{{ route('profile.following', ['username' => $user->username]) }}" class="py-3 px-4 border-b-2 border-primary text-white font-bold text-sm uppercase tracking-wider transition-colors">
                Following <span class="text-xs text-gray-500 ml-1">({{ $following->count() }})</span>
            </a>
        </div>

        <!-- Following List -->
        <div>
            <h2 class="text-white font-bold text-lg mb-4">People {{ $user->username }} follows</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @if($following->isEmpty())
                    <div class="col-span-full text-center text-textMuted py-12">
                        Not following anyone yet.
                    </div>
                @else
                    @foreach($following as $follow)
                    <a href="{{ route('profile.watched', ['username' => $follow->followingUser->username]) }}"
                       class="group block bg-darker rounded-lg p-4 hover:shadow-lg hover:border-primary border border-gray-800 transition-all">
                        <div class="flex flex-col items-center text-center gap-3">
                            <img
                              src="{{ $follow->followingUser->avatar ? asset('storage/profile/' . $follow->followingUser->avatar) : 'https://i.pravatar.cc/150?img=12' }}"
                              alt="{{ $follow->followingUser->username }}"
                              class="w-16 h-16 rounded-full object-cover border-2 border-white/10 group-hover:border-primary transition-colors"
                              loading="lazy"
                            />
                            <p class="text-white font-semibold text-sm truncate w-full">{{ $follow->followingUser->username ?? 'Unknown' }}</p>
                        </div>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    @include('profile._edit_profile_modal')
</div>

@endsection
