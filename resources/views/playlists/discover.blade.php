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
            <div>
                <p class="text-sm text-textMuted uppercase tracking-widest">Playlist</p>
                <h1 class="text-3xl font-bold text-white">{{ $playlist->name }}</h1>
                @if($playlist->description)
                    <p class="text-textMuted mt-1">{{ $playlist->description }}</p>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ url()->previous() }}" class="px-4 py-2 rounded border border-gray-700 text-textMuted hover:text-white hover:border-white transition-colors text-sm font-semibold">Back</a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
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
@endsection
