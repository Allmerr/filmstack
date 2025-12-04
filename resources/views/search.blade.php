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
          @foreach ($films as $key => $film)
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
          </a>    
          @endforeach
        </div>
        <div class="mt-6 border-t border-gray-800 pt-6">
          @if(isset($users) && count($users) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
              @foreach($users as $user)
                <a href="/profile/{{ $user['username'] }}/watched"
                   class="group block bg-darker rounded-md p-3 hover:shadow-lg border border-gray-800 transition-colors"
                   aria-label="{{  ($user['username'] ?? 'View user') }}">
                  <div class="flex items-center space-x-3">
                    <img
                      src="{{ 'https://i.pravatar.cc/150?img=12'}}"
                      alt="{{ $user['username'] }}"
                      class="w-14 h-14 rounded-full object-cover border border-white/10"
                      loading="lazy"
                    />
                    <div class="flex-1 min-w-0">
                      <p class="text-white font-semibold text-sm truncate">{{ $user['username'] ?? 'Unknown' }}</p>
                      @if(Auth::check() && Auth::user()->username !== $user['username'])
                        <form method="POST" action="{{ route('following.store') }}" class="mt-1">
                          <input type="hidden" name="following_to_users_id" value="{{ $user['id'] }}">
                          @csrf
                          @if($user->alreadyFollowing)  
                            <input type="hidden" name="alreadyFollowing"  value="1">
                              <button
                              type="submit"
                              class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-md bg-white/5 text-textMuted border border-gray-700 hover:bg-white/10 transition-colors"
                              aria-label="Unfollow {{ $user['username'] }}"
                            >
                              Unfriends
                            </button>
                          @else
                            <button
                              type="submit"
                              class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-md bg-primary text-dark hover:bg-green-600 transition-colors"
                              aria-label="Follow {{ $user['username'] }}"
                            >
                              Add friends
                            </button>
                          @endif
                        </form>
                      @endif
                    </div>
                  </div>
                </a>
              @endforeach
            </div>

            @if(method_exists($users, 'links'))
              <div class="mt-4">
                {{ $users->links() }}
              </div>
            @endif
          @else
            <div class="py-6 text-center text-textMuted">
              No users found for "{{ request('user_query') }}" .
            </div>
          @endif
        </div>
        </div>
    </main>
@endsection