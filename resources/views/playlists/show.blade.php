@extends('layouts.main')
@push('css')
<style>
 /* Card Hover Effects */
.movie-card:hover .overlay {
    opacity: 1;
}
.movie-card:hover .poster-img {
    transform: scale(1.05);
    border-color: #00e054;
}    
</style>
@endpush
@section('content')
<div class="fade-in min-h-screen pb-20 bg-dark px-4 md:px-6">
    <div class="max-w-5xl mx-auto py-10">
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1">
                <p class="text-sm text-textMuted uppercase tracking-widest">Playlist</p>
                <h1 class="text-3xl font-bold text-white mb-2">{{ $playlist->name }}</h1>
                @if($playlist->description)
                    <p class="text-textMuted mt-1 mb-3">{{ $playlist->description }}</p>
                @endif
                <div class="flex items-center gap-4 mt-4">
                    <a href="{{ route('profile.watched', $playlist->user->username ?? 'unknown') }}" class="flex items-center gap-2 group">

                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-dark text-sm font-bold">
                            <img src="{{ $playlist->user->avatar ? asset('storage/profile/' . $playlist->user->avatar) : 'https://i.pravatar.cc/150?img=12' }}" alt="" class="w-8 h-8 rounded-full object-cover" />
                        </div>
                        <div>
                            <p class="text-white font-semibold group-hover:text-primary transition-colors">{{ $playlist->user->username ?? 'Unknown' }}</p>
                            <p class="text-textMuted text-xs">Creator</p>
                        </div>
                    </a>
                    <div class="border-l border-gray-700 pl-4">
                        <p class="text-white font-semibold">{{ $playlist->filmofplaylists->count() }}</p>
                        <p class="text-textMuted text-xs">Films</p>
                    </div>
                    <div class="border-l border-gray-700 pl-4">
                        <p class="text-white font-semibold">{{ $playlist->created_at->format('M d, Y') }}</p>
                        <p class="text-textMuted text-xs">Created {{ $playlist->created_at->diffForHumans() }}</p>
                    </div>
                    @if($playlist->visibility)
                        <div class="border-l border-gray-700 pl-4">
                            <p class="text-white font-semibold capitalize">{{ $playlist->visibility }}</p>
                            <p class="text-textMuted text-xs">Visibility</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ url()->previous() }}" class="px-4 py-2 rounded border border-gray-700 text-textMuted hover:text-white hover:border-white transition-colors text-sm font-semibold">Back</a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @if($playlist->filmofplaylists->isEmpty())
                <div class="col-span-full text-center text-textMuted py-12">This playlist is empty.</div>
            @else
                @foreach($playlist->filmofplaylists as $film)
                <a href="/film/{{ $film['id'] ?? $key }}" class="movie-card group relative flex-shrink-0 cursor-pointer w-full block no-underline" aria-label="{{ $film['original_title'] ?? 'View movie' }}">
                    <div class="relative w-full pb-[150%] overflow-hidden rounded-md shadow-lg border border-white/10 transition-all duration-300 hover:ring-2 hover:ring-primary hover:shadow-primary/20">
                    
                    <img 
                        src=" https://image.tmdb.org/t/p/w500/{{ $film['poster_path'] ?? '' }}" 
                        alt="{{ $film['original_title'] ?? '' }}"
                        class="poster-img absolute inset-0 w-full h-full object-cover transition-transform duration-500"
                        loading="lazy"
                    />

                    <div class="overlay absolute inset-0 bg-black/80 opacity-0 transition-opacity duration-200 flex flex-col justify-end p-4 text-center">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="inline-block text-primary mb-1">
                            <svg class="w-6 h-6 mx-auto fill-current" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            </span>
                            <p class="text-white font-bold text-lg leading-tight mb-1">{{ $film['vote_average'] ?? ''}} - {{ $film['vote_count'] ?? ''}}</p>
                            <p class="text-textMuted text-xs uppercase tracking-wider mb-3">Rating</p>
                        </div>
                    </div>
                    </div>
                    
                    <div class="mt-2 hidden group-hover:block absolute top-full left-0 w-full z-20 bg-darker p-2 rounded shadow-xl border border-gray-800">
                    <h3 class="text-white font-bold text-sm truncate">{{ $film['original_title'] ?? '' }}</h3>
                    <p class="text-textMuted text-xs">{{ $film['release_date'] ?? '' }}</p>
                    </div>
                    @auth
                    @if(auth()->id() === $playlist->users_id)
                    <form method="POST" action="{{ route('playlists.film.remove', [$playlist->id, $film->id_films]) }}" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-black/70 hover:bg-red-600 text-white text-xs px-2 py-1 rounded shadow-sm transition">Remove</button>
                    </form>
                    @endif
                    @endauth
                </a> 
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
