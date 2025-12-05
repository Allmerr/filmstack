@extends('layouts.main')

@section('content')
<div class="fade-in min-h-screen pb-16 bg-dark px-4 md:px-6">
    <div class="max-w-5xl mx-auto py-10">
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-xs uppercase tracking-widest text-textMuted">Browse</p>
                <h1 class="text-3xl font-bold text-white">All Playlists</h1>
                <p class="text-textMuted text-sm mt-1">Lihat playlist dari seluruh pengguna.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($playlists as $playlist)
            <a href="{{ route('playlists.show', $playlist->id) }}" class="bg-[#1f252b] rounded-lg p-4 border border-white/5 hover:border-primary transition-all group block">
                <div class="flex -space-x-4 mb-4 h-24 overflow-hidden relative">
                    @if($playlist->filmofplaylists->count() == 0)
                        <div class="w-full h-24 bg-gray-800 rounded flex items-center justify-center text-textMuted text-xs">Empty</div>
                    @endif
                    @foreach($playlist->filmofplaylists->take(3) as $film)
                        @php $poster = $film->poster_path ? 'https://image.tmdb.org/t/p/w500'.$film->poster_path : 'https://via.placeholder.com/200x300?text=No+Image'; @endphp
                        <img src="{{ $poster }}" class="w-16 h-24 object-cover rounded shadow-lg border-2 border-[#1f252b] transform group-hover:scale-105 transition-transform z-10" loading="lazy">
                    @endforeach
                </div>
                <h3 class="text-white font-bold text-lg group-hover:text-primary transition-colors">{{ $playlist->name }}</h3>
                <p class="text-textMuted text-xs uppercase tracking-wider">{{ $playlist->filmofplaylists->count() }} Films • by {{ $playlist->user->username ?? 'Unknown' }}</p>
            </a>
            @empty
            <div class="col-span-full text-center text-textMuted py-12">Belum ada playlist.</div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $playlists->links() }}
        </div>
    </div>
</div>
@endsection
