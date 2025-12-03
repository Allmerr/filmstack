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
   <main class="flex-grow bg-dark py-12 px-4 md:px-6">
      <div class="max-w-5xl mx-auto">
        <!-- Section Header -->
        <div class="flex items-end justify-between mb-4 border-b border-gray-800 pb-2">
          <h2 class="text-textMuted text-sm font-semibold uppercase tracking-widest hover:text-white cursor-pointer transition-colors">
            Search Results for "{{ request('query') }}"
          </h2>
        </div>
        <div id="movie-grid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 md:gap-4">
          <!-- Skeletons (Loading State) -->
          @foreach ($films as $key => $d)
          <a href="/film/{{ $d['id'] ?? $key }}" class="movie-card group relative flex-shrink-0 cursor-pointer w-full block no-underline" aria-label="{{ $d['primaryTitle'] ?? 'View movie' }}">
            <div class="relative w-full pb-[150%] overflow-hidden rounded-md shadow-lg border border-white/10 transition-all duration-300 hover:ring-2 hover:ring-primary hover:shadow-primary/20">
              
              <img 
                src="{{ $d['primaryImage']['url'] ?? '' }}" 
                alt="${movie.title}"
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
                    <p class="text-white font-bold text-lg leading-tight mb-1">{{ $d['rating']['aggregateRating'] ?? ''}} - {{ $d['rating']['voteCount'] ?? ''}}</p>
                    <p class="text-textMuted text-xs uppercase tracking-wider mb-3">Rating</p>
                  </div>
              </div>
            </div>
            
            <div class="mt-2 hidden group-hover:block absolute top-full left-0 w-full z-20 bg-darker p-2 rounded shadow-xl border border-gray-800">
              <h3 class="text-white font-bold text-sm truncate">{{ $d['primaryTitle'] ?? '' }}</h3>
              <p class="text-textMuted text-xs">{{ $d['startYear'] ?? '' }}</p>
            </div>
          </a>    
          @endforeach
        </div>
        </div>
    </main>
@endsection