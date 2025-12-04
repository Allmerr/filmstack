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
        
    <!-- Hero Section -->
    <header class="relative overflow-hidden bg-darker pb-12 pt-16 lg:pt-24 text-center px-4">
       <!-- Background Glow -->
      <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[80%] bg-primary blur-[120px] rounded-full opacity-10 mix-blend-screen"></div>
        <div class="absolute top-[20%] right-[10%] w-[30%] h-[60%] bg-blue-600 blur-[100px] rounded-full opacity-10 mix-blend-screen"></div>
      </div>

      <div class="relative z-10 max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6 leading-tight">
          Track films you’ve watched. <br />
          <span class="text-textMuted">Save those you want to see.</span>
        </h1>
        <p className="text-lg md:text-xl text-textMuted mb-8 max-w-2xl mx-auto">
          The social network for film lovers. Tell your friends what’s good. 
        </p>
        <button class="bg-primary hover:bg-primaryHover text-white font-bold py-3 px-8 rounded text-lg transition-transform transform hover:scale-105 shadow-lg shadow-green-900/50 mt-5">
          Get Started — It's Free!
        </button>
      </div>
    </header>

    @auth
             <p class="text-xl md:text-2xl text-white font-extrabold leading-tight text-center mt-12">
                Welcome back, <span class="text-primary">@</span><span class="text-primary">{{ auth()->user()->username ?? auth()->user()->email }}</span>
              </p>
              <p class="text-textMuted text-sm mt-1 text-center mb-4">
                Ready to discover something great? Check your personalized picks and continue your streak.
              </p>
   
        @endauth

    <!-- Main Content -->
    <main class="flex-grow bg-dark py-12 px-4 md:px-6">
      <div class="max-w-5xl mx-auto">
        
        <!-- Section Header -->
        <div class="flex items-end justify-between mb-4 border-b border-gray-800 pb-2">
          <h2 class="text-textMuted text-sm font-semibold uppercase tracking-widest hover:text-white cursor-pointer transition-colors">
            Popular on CineLog this Week
          </h2>
          <a href="#" class="text-xs text-textMuted hover:text-white transition-colors">More</a>
        </div>

        <!-- Movie Grid -->
        <div id="movie-grid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 md:gap-4">
          <!-- Skeletons (Loading State) -->
          @foreach ($films as $key => $film)
          <a href="/film/{{ $film['id'] ?? $key }}" class="movie-card group relative flex-shrink-0 cursor-pointer w-full block no-underline" aria-label="{{ $film['original_title'] ?? 'View movie' }}">
            <div class="relative w-full pb-[150%] overflow-hidden rounded-md shadow-lg border border-white/10 transition-all duration-300 hover:ring-2 hover:ring-primary hover:shadow-primary/20">
              
              <img 
                src=" https://image.tmdb.org/t/p/w500/{{ $film['poster_path'] ?? '' }}" 
                alt="{{ $film['original_title'] ?? 'Movie poster' }}"
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
                    @php
                      $local = isset($localRatings) && isset($film['id']) ? ($localRatings[$film['id']] ?? null) : null;
                    @endphp
                    <p class="text-white font-bold text-lg leading-tight mb-1">{{ $local ? $local['avg'] : ($film['vote_average'] ?? '') }} - {{ $local ? $local['count'] : ($film['vote_count'] ?? '') }}</p>
                    <p class="text-textMuted text-xs uppercase tracking-wider mb-3">Rating</p>
                  </div>
              </div>
            </div>
            
            <div class="mt-2 hidden group-hover:block absolute top-full left-0 w-full z-20 bg-darker p-2 rounded shadow-xl border border-gray-800">
              <h3 class="text-white font-bold text-sm truncate">{{ $film['original_title'] ?? '' }}</h3>
              <p class="text-textMuted text-xs">{{ $film['release_date'] ?? '' }}</p>
            </div>
          </a>    
          @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="py-8 px-4 text-center border-t border-gray-800 mt-12">
          <div class="flex justify-center items-center gap-4">
            @if($currentPage > 1)
              <a href="/?page={{ $currentPage - 1 }}" class="bg-primary hover:bg-primaryHover text-white font-bold py-2 px-6 rounded transition-colors">
                ← Previous
              </a>
            @else
              <button disabled class="bg-gray-600 text-gray-400 font-bold py-2 px-6 rounded cursor-not-allowed">
                ← Previous
              </button>
            @endif

            <span class="text-white font-semibold">
              Page <span class="text-primary">{{ $currentPage }}</span> of <span class="text-primary">{{ $totalPages }}</span>
            </span>

            @if($currentPage < $totalPages)
              <a href="/?page={{ $currentPage + 1 }}" class="bg-primary hover:bg-primaryHover text-white font-bold py-2 px-6 rounded transition-colors">
                Next →
              </a>
            @else
              <button disabled class="bg-gray-600 text-gray-400 font-bold py-2 px-6 rounded cursor-not-allowed">
                Next →
              </button>
            @endif
          </div>
        </div>

        <!-- CTA Section -->
        <div class="py-20 px-4 text-center border-t border-gray-800 mt-12">
             <h2 class="text-2xl font-bold text-white mb-4">Film data from TMDb.</h2>
             <p class="text-textMuted max-w-lg mx-auto mb-8">
               Filmstack is a mobile-first experience. Available on iOS and Android.
               <br/>
               Made for film lovers, by film lovers.
             </p>
             <div class="flex justify-center gap-4">
                <button class="bg-white text-dark font-bold py-2 px-6 rounded hover:bg-gray-200 transition-colors">
                  App Store
                </button>
                <button class="bg-white text-dark font-bold py-2 px-6 rounded hover:bg-gray-200 transition-colors">
                  Google Play
                </button>
             </div>
        </div>

      </div>
    </main>
@endsection