@extends('layouts.main')
@push('css')
@endpush
@section('content')
     <div class="fade-in bg-dark min-h-screen pb-20">
          <!-- Cinematic Backdrop -->
          <div class="relative w-full h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $data['primaryImage']['url'] ?? '' }}');"></div>
            <!-- Gradient Overlays -->
            <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/40 to-transparent"></div>
          </div>

          <!-- Main Content -->
          <div class="max-w-5xl mx-auto px-6 -mt-32 relative z-10">
            <div class="flex flex-col md:flex-row gap-8">
              
              <!-- Left: Poster -->
              <div class=" w-48 md:w-64 mx-auto md:mx-0">
                <div class="rounded-lg overflow-hidden shadow-2xl ring-1 ring-white/10 group">
                  <img src="{{ $data['primaryImage']['url'] ?? '' }}" alt="{{ $data['titleText']['text'] ?? '' }}" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700"/>
                </div>
              </div>

              <!-- Right: Details -->
              <div class="flex-grow pt-4 md:pt-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2 leading-tight drop-shadow-lg tracking-tight font-serif">{{ $data['primaryTitle'] ?? '' }}</h1>
                
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 text-sm text-textMuted mb-6 font-medium tracking-wide">
                  <span class="text-white">{{ $data['releaseYear'] ?? '' }}</span>
                  <span>{{ $data['startYear'] ?? '' }}</span>
                  <span>•</span>
                  <span>{{ $data['directors'][0]['displayName'] ?? '' }}</span>
                </div>

                <!-- Action Bar (Glassmorphism) -->
                <div class="bg-[#1f252b]/60 backdrop-blur-md border border-white/5 rounded-xl p-4 mb-8 inline-flex flex-col sm:flex-row items-center gap-4 shadow-xl">
                   
                   <!-- Interactive Buttons -->
                   <div class="flex gap-3">
                     <form action="{{ route('watched.store') }}" method="POST">
                      @csrf
                        <input type="hidden" name="id_films" value="{{ $data['id'] }}">
                        @if($watched->contains('users_id', auth()->id()))
                        <input type="hidden" name="alreadyLiked" value="1">
                        <button type="submit" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 border-green-500/50 bg-green-500/10 transition-all duration-300">
                        <svg class="w-5 h-5  text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span class="font-bold text-sm text-textMuted text-white">Unwatch</span>
                        @else
                        <input type="hidden" name="alreadyLiked" value="0">
                        <button type="submit" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-green-500/50 hover:bg-green-500/10 transition-all duration-300">
                        <svg class="w-5 h-5 text-textMuted group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span class="font-bold text-sm text-textMuted group-hover:text-white">Watch</span>
                        @endif
                      </button>
                     </form>

                     <form action="{{ route('liked.store') }}" method="POST">
                      @csrf
                        <input type="hidden" name="id_films" value="{{ $data['id'] }}">
                        @if($liked->contains('users_id', auth()->id()))
                        <input type="hidden" name="alreadyLiked" value="1">
                        <button type="submit" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 border-pink-500/50 bg-pink-500/10 transition-all duration-300">
                        <svg class="w-5 h-5 text-pink-500 fill-current transition-colors" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657 3.172 10.828a4 4 0 010-5.656z"/></svg>
                        <span class="font-bold text-sm text-textMuted text-white">Unlike</span>
                        @else
                        <input type="hidden" name="alreadyLiked" value="0">
                        <button type="submit" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-pink-500/50 hover:bg-pink-500/10 transition-all duration-300">
                        <svg class="w-5 h-5 text-textMuted group-hover:text-pink-500 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657 3.172 10.828a4 4 0 010-5.656z"/></svg>
                        <span class="font-bold text-sm text-textMuted group-hover:text-white">Like</span>
                        @endif
                      </button>
                     </form>

                     <form action="{{ route('watchlist.store') }}" method="POST">
                        @csrf
                           <input type="hidden" name="id_films" value="{{ $data['id'] }}">
                           @if($watchlist->contains('users_id', auth()->id()))
                           <input type="hidden" name="alreadyInWatchlist" value="1">
                           <button type="submit" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 border-blue-500/50 bg-blue-500/10 transition-all duration-300">
                           <svg class="w-5 h-5  text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z"></path></svg>
                           <span class="font-bold text-sm text-textMuted text-white">Remove</span>
                           @else
                           <input type="hidden" name="alreadyInWatchlist" value="0">
                           <button type="submit" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all duration-300">
                           <svg class="w-5 h-5 text-textMuted group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z"></path></svg>
                           <span class="font-bold text-sm text-textMuted group-hover:text-white">Watchlist</span>
                           @endif
                        </button>
                     </form>
                     
                      <!-- ADD TO LIST BUTTON -->
                      <button onclick="openPlaylistModal('{{ $data['id'] }}')" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-purple-500/50 hover:bg-purple-500/10 transition-all duration-300">
                         <svg class="w-5 h-5 text-textMuted group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                         <span class="font-bold text-sm text-textMuted group-hover:text-white">List</span>
                      </button>
                   </div>

                   <div class="w-px h-8 bg-white/10 hidden sm:block"></div>

                   <!-- Rating -->
                  <form action="{{ route('rated.store') }}" method="POST">
                     @csrf
                     <input type="hidden" name="id_films" value="{{ $data['id'] }}">
                   <div class="flex items-center gap-1">
                      <span class="text-xs uppercase font-bold text-textMuted mr-2">Rate</span>
                      <div class="flex text-gray-600 hover:text-primary transition-colors cursor-pointer" id="film-rating-stars">
                        @if($rated->contains('users_id', auth()->id()))
                          @php
                            $userRating = $rated->firstWhere('users_id', auth()->id())->rating;
                          @endphp
                          @foreach ([1,2,3,4,5] as $i)
                              <input type="hidden" name="isAlreadyRated" value="1">
                             @if($i <= $userRating)
                               <button type="submit" name="rating" value="{{ $i }}" onclick="rateMovie(this, {{ $i }})" aria-label="Rate {{ $i }} star" class="p-0 m-0 bg-transparent border-0 cursor-pointer">
                                  <svg class="w-6 h-6 text-primary fill-current stroke-current transition-all duration-200" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                  </svg>
                               </button>
                             @else
                               <button type="submit" name="rating" value="{{ $i }}" onclick="rateMovie(this, {{ $i }})" aria-label="Rate {{ $i }} star" class="p-0 m-0 bg-transparent border-0 cursor-pointer">
                                  <svg class="w-6 h-6 hover:text-primary hover:fill-current fill-transparent stroke-current transition-all duration-200" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                 </svg>
                              </button>
                              @endif
                           @endforeach
                        @else
                           @foreach ([1,2,3,4,5] as $i)
                               <input type="hidden" name="isAlreadyRated" value="0">
                             <button type="submit" name="rating" value="{{ $i }}" onclick="rateMovie(this, {{ $i }})" aria-label="Rate {{ $i }} star" class="p-0 m-0 bg-transparent border-0 cursor-pointer">
                                <svg class="w-6 h-6 hover:text-primary hover:fill-current fill-transparent stroke-current transition-all duration-200" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                             </button>
                           @endforeach
                        @endif 
                      </div>
                   </div>
                  </form>  

                </div>

                <div class="div">
                  <!-- Plot -->
                  <h3 class="text-textMuted uppercase text-xs font-bold tracking-widest mb-2 border-b border-gray-800 pb-2 inline-block ">Plot Summary</h3>
                  <p class="text-lg leading-relaxed text-[#99aabb] font-serif max-w-2xl mx-auto md:mx-0">
                    {{ $data['plot'] ?? 'No plot summary available.' }}
                  </p>
                </div>

                <!-- Genres -->
                 <div class="mt-6 flex flex-wrap justify-center md:justify-start gap-2">
                  @foreach ($data['genres'] as $genre)
                    <span class="px-3 py-1 rounded-full bg-[#2c3440] text-xs text-textLight font-medium border border-white/5 hover:bg-gray-700 cursor-pointer transition-colors">
                      {{ $genre }}
                    </span>
                  @endforeach
                 </div>
              </div>
            </div>

            <!-- Cast & Tabs Placeholder -->
            <div class="mt-16 border-t border-gray-800 pt-8">
               <div class="flex gap-8 mb-6 border-b border-gray-800 text-sm font-bold uppercase tracking-widest">
                  <button class="pb-3 border-b-2 border-primary text-white">Cast</button>
                  <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">Crew</button>
                  <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">Details</button>
               </div>
               
               <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                  
                  @foreach ($data['writers'] as $i)
                    <div class="flex items-center gap-3 bg-[#1f252b] p-2 rounded border border-white/5">
                       <div class="w-10 h-10 bg-gray-700 rounded-full flex-shrink-0">
                          <img src="{{ $i['primaryImage']['url'] ?? '' }}" alt="" class="w-full h-full object-cover rounded-full"/>
                       </div>
                       <div class="overflow-hidden">
                          <p class="text-white text-xs font-bold truncate">{{ $i['displayName'] }}</p>
                       </div>
                    </div>
                  @endforeach
               </div>
            </div>
<!-- 
          -->

              <div class="mt-12">
                <div class="flex items-center justify-between mb-6">
                  <h3 class="text-white font-bold text-xl">Reviews</h3>
                  <div class="text-xs font-bold text-primary uppercase tracking-widest cursor-pointer hover:underline">Read All</div>
                </div>

                <!-- Comment Input -->
                 <form action="{{ route('reviews.store') }}" method="POST">
                  @csrf
                  @if(session('error'))
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                      {{ session('error') }}
                    </div>
                  @endif
                  <input type="hidden" name="id_films" value="{{ $data['id'] }}">
                <div class="bg-[#1f252b] p-6 rounded-lg border border-white/5 mb-8 shadow-inner">
                     <textarea id="comment-input" name="review" class="w-full bg-[#14181c] text-white p-3 rounded border border-gray-700 focus:border-primary focus:outline-none transition-colors placeholder-textMuted text-sm" rows="3" placeholder="Add a review..."></textarea>
                     <button type="submit" class="bg-primary hover:bg-white text-darker font-bold py-2 px-6 rounded text-sm transition-all transform hover:scale-105">Post</button>
                </div>
                  </form>

                <!-- List -->
                  <div class="mt-16 border-t border-gray-800">
                     <div class="flex gap-8 mb-6 mt-8 border-b border-gray-800 text-sm font-bold uppercase tracking-widest">
                        <button class="pb-3 border-b-2 border-primary text-white">Reviews</button>
                        <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">Ratings</button>
                        <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">More Like This</button>
                     </div>
                     @foreach ($reviews as $review)
                     <div class="flex gap-4 p-4 rounded-lg bg-[#1f252b] border border-white/5 animate-[fadeIn_0.3s_ease-out]">
                        <div class="flex-shrink-0">
                           <img src="{{ 'https://i.pravatar.cc/150?img=12'}}" alt="" class="w-10 h-10 rounded-full border border-gray-600">
                        </div>
                        <div class="flex-grow">
                           <div class="flex justify-between items-center mb-1">
                              <span class="text-white font-bold text-sm"><a href="{{ route('profile.watched', ['username' => $review->user->username]) }}"><span>@</span>{{ $review->user->username }}</a></span>
                              <span class="text-textMuted text-xs">{{ $review->created_at }}</span>
                           </div>
                           <!-- <div class="flex mb-2">
                           ${[1,2,3,4,5].map(i => `
                              <svg class="w-3 h-3 ${i <= c.rating ? 'text-primary fill-current' : 'text-gray-600'}" viewBox="0 0 24 24">
                                 <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                              </svg>
                           `).join('')}
                           </div> -->
                           <p class="text-gray-300 text-sm leading-relaxed">{{ $review->review }}</p>
                        </div>
                     </div>
                     @endforeach
              </div>

            </div>

          </div>
        </div>
        
                  <div id="playlist-modal" class="fixed inset-0 z-[60] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
                     <!-- Overlay -->
                     <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closePlaylistModal()"></div>
                     
                     <!-- Card -->
                     <div class="bg-[#1f252b] w-full max-w-md rounded-xl shadow-2xl border border-white/10 relative transform scale-95 transition-all duration-300 z-10 overflow-hidden">
                        <div class="p-6">
                           <div class="flex justify-between items-center mb-6">
                                 <h3 class="text-white font-bold text-xl">Add to Playlist</h3>
                                 <button onclick="closePlaylistModal()" class="text-textMuted hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                 </button>
                           </div>
                           
                           <!-- Playlist Items -->
                           <div id="playlist-items-container" class="space-y-2 max-h-64 overflow-y-auto mb-6 custom-scrollbar pr-2">
                                 <!-- Items injected by JS -->
                           </div>

                           <!-- Create New -->
                           <div class="pt-4 border-t border-white/10">
                                 <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-2">Create New Playlist</label>
                                 <div class="flex gap-2">
                                    <input id="new-playlist-name" type="text" placeholder="Name..." class="bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 flex-grow focus:border-primary focus:outline-none transition-colors">
                                    <button onclick="createNewPlaylist('${id}')" class="bg-primary hover:bg-white text-darker font-bold text-sm px-4 rounded transition-colors whitespace-nowrap">Create</button>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
@endsection

@push('js')
<script>
      function rateMovie(star, rating) {
          const parent = star.parentElement;
          const stars = parent.querySelectorAll('svg');
          stars.forEach((s, index) => {
              if (index < rating) {
                  s.classList.add('text-primary', 'fill-current');
                  s.classList.remove('text-gray-600', 'fill-transparent');
              } else {
                  s.classList.remove('text-primary', 'fill-current');
                  s.classList.add('text-gray-600', 'fill-transparent');
              }
          });
      }

      function getCommentsHTML(movieId) {
        const comments = movieComments[movieId] || [];
        
        const listHTML = comments.length > 0 ? comments.map(c => `
          <div class="flex gap-4 p-4 rounded-lg bg-[#1f252b] border border-white/5 animate-[fadeIn_0.3s_ease-out]">
            <div class="flex-shrink-0">
               <img src="${c.avatar || 'https://i.pravatar.cc/150?img=12'}" alt="${c.user}" class="w-10 h-10 rounded-full border border-gray-600">
            </div>
            <div class="flex-grow">
               <div class="flex justify-between items-center mb-1">
                  <span class="text-white font-bold text-sm">${c.user}</span>
                  <span class="text-textMuted text-xs">${c.date}</span>
               </div>
               <div class="flex mb-2">
                 ${[1,2,3,4,5].map(i => `
                    <svg class="w-3 h-3 ${i <= c.rating ? 'text-primary fill-current' : 'text-gray-600'}" viewBox="0 0 24 24">
                       <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                 `).join('')}
               </div>
               <p class="text-gray-300 text-sm leading-relaxed">${c.text}</p>
            </div>
          </div>
        `).reverse().join('') : `<p class="text-textMuted text-sm italic py-4">No reviews yet. Be the first to share your thoughts!</p>`;

        return `
            <div class="mt-12 max-w-3xl">
                <div class="flex items-center justify-between mb-6">
                  <h3 class="text-white font-bold text-xl">Reviews <span class="text-textMuted text-sm font-normal ml-1">(${comments.length})</span></h3>
                  <div class="text-xs font-bold text-primary uppercase tracking-widest cursor-pointer hover:underline">Read All</div>
                </div>

                <!-- Comment Input -->
                <div class="bg-[#1f252b] p-6 rounded-lg border border-white/5 mb-8 shadow-inner">
                   <div class="flex gap-4">
                      <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-dark font-bold text-sm flex-shrink-0">
                        Me
                      </div>
                      <div class="flex-grow">
                        <textarea id="comment-input" class="w-full bg-[#14181c] text-white p-3 rounded border border-gray-700 focus:border-primary focus:outline-none transition-colors placeholder-textMuted text-sm" rows="3" placeholder="Add a review..."></textarea>
                        
                        <div class="flex justify-between items-center mt-3">
                            <div class="flex items-center gap-2">
                               <span class="text-xs text-textMuted font-bold uppercase mr-2">Your Rating:</span>
                               <div class="flex cursor-pointer group" id="new-comment-rating">
                                  ${[1,2,3,4,5].map(i => `
                                    <svg onclick="setRating(${i})" data-val="${i}" class="star-input w-5 h-5 text-gray-600 hover:text-primary transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                       <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                  `).join('')}
                               </div>
                            </div>
                            <button onclick="postComment('${movieId}')" class="bg-primary hover:bg-white text-darker font-bold py-2 px-6 rounded text-sm transition-all transform hover:scale-105">Post</button>
                        </div>
                      </div>
                   </div>
                </div>

                <!-- List -->
                <div id="comment-list" class="space-y-4">
                   ${listHTML}
                </div>
            </div>
        `;
      }

      const currentUser = {
          username: "FilmBuff99",
          handle: "@filmbuff99",
          avatar: "https://i.pravatar.cc/150?u=me",
          bio: "Cinema addict. Noir enthusiast. I watch movies so you don't have to.",
          stats: {
              watched: 142,
              thisYear: 24,
              lists: 3,
              following: 88,
              followers: 340
          },
          // IDs of movies watched/liked
          watched: ['1', '3', '5', '6'],
          liked: ['2', '4', '6'],
          // Mock Playlists
          playlists: [
            { id: 'pl1', name: 'Weekend Vibes', count: 4, movieIds: ['1', '2'] },
            { id: 'pl2', name: 'Sci-Fi Masterpieces', count: 12, movieIds: ['1'] },
            { id: 'pl3', name: 'To Watch with Dad', count: 2, movieIds: [] }
          ]
      };

      function openPlaylistModal(movieId) {
         const modal = document.getElementById('playlist-modal');
         const container = document.getElementById('playlist-items-container');
         
          if(!modal || !container) return;

          // Render list
          container.innerHTML = currentUser.playlists.map(pl => {
              const inList = pl.movieIds.includes(movieId);
              return `
                <div onclick="toggleMovieInPlaylist('${pl.id}', '${movieId}')" class="flex items-center justify-between p-3 rounded bg-[#14181c] border border-white/5 hover:bg-[#2c3440] cursor-pointer group transition-colors">
                    <div>
                        <p class="text-white font-bold text-sm">${pl.name}</p>
                        <p class="text-textMuted text-xs">${pl.count} items</p>
                    </div>
                    <div id="check-${pl.id}" class="w-6 h-6 rounded-full border border-gray-600 flex items-center justify-center ${inList ? 'bg-primary border-primary' : ''} transition-colors">
                         ${inList ? '<svg class="w-4 h-4 text-darker font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>' : ''}
                    </div>
                </div>
              `;
          }).join('');

          // Show modal
          modal.classList.remove('opacity-0', 'pointer-events-none');
          const card = modal.querySelector('.transform');
          card.classList.remove('scale-95');
          card.classList.add('scale-100');
      }

      function closePlaylistModal() {
          const modal = document.getElementById('playlist-modal');
          if(!modal) return;
          
          const card = modal.querySelector('.transform');
          card.classList.remove('scale-100');
          card.classList.add('scale-95');
          
          modal.classList.add('opacity-0', 'pointer-events-none');
      }

      function toggleMovieInPlaylist(playlistId, movieId) {
          const playlist = currentUser.playlists.find(p => p.id === playlistId);
          if(!playlist) return;

          const index = playlist.movieIds.indexOf(movieId);
          const checkEl = document.getElementById(`check-${playlistId}`);

          if(index > -1) {
              // Remove
              playlist.movieIds.splice(index, 1);
              playlist.count--;
              checkEl.classList.remove('bg-primary', 'border-primary');
              checkEl.innerHTML = '';
          } else {
              // Add
              playlist.movieIds.push(movieId);
              playlist.count++;
              checkEl.classList.add('bg-primary', 'border-primary');
              checkEl.innerHTML = '<svg class="w-4 h-4 text-darker font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>';
          }
      }

      function createNewPlaylist(movieId) {
          const input = document.getElementById('new-playlist-name');
          const name = input.value.trim();
          
          if(!name) {
              alert("Please enter a playlist name.");
              return;
          }

          const newId = 'pl' + Date.now();
          const newPlaylist = {
              id: newId,
              name: name,
              count: 1,
              movieIds: [movieId] // Auto add current movie
          };

          currentUser.playlists.push(newPlaylist);
          input.value = ''; // Reset input

          // Re-render list inside modal to show new item
          openPlaylistModal(movieId);
      }

      </script>
  @endpush