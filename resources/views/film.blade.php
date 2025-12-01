@extends('layouts.main')
@section('content')
     <div class="fade-in bg-dark min-h-screen pb-20">
          <!-- Cinematic Backdrop -->
          <div class="relative w-full h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('${movie.backdrop || movie.img}');"></div>
            <!-- Gradient Overlays -->
            <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/40 to-transparent"></div>
          </div>

          <!-- Main Content -->
          <div class="max-w-5xl mx-auto px-6 -mt-32 relative z-10">
            <div class="flex flex-col md:flex-row gap-8">
              
              <!-- Left: Poster -->
              <div class="flex-shrink-0 w-48 md:w-64 mx-auto md:mx-0">
                <div class="rounded-lg overflow-hidden shadow-2xl ring-1 ring-white/10 group">
                  <img src="${movie.img}" alt="${movie.title}" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700"/>
                </div>
                
                <!-- Streaming Services (Mock) -->
                <div class="mt-4 flex justify-center gap-2">
                  <div class="w-10 h-10 rounded bg-[#1f252b] border border-white/10 flex items-center justify-center cursor-pointer hover:border-primary transition-colors">
                    <span class="text-[10px] font-bold text-textMuted">NETFLIX</span>
                  </div>
                   <div class="w-10 h-10 rounded bg-[#1f252b] border border-white/10 flex items-center justify-center cursor-pointer hover:border-primary transition-colors">
                    <span class="text-[10px] font-bold text-textMuted">AMZN</span>
                  </div>
                </div>
              </div>

              <!-- Right: Details -->
              <div class="flex-grow pt-4 md:pt-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2 leading-tight drop-shadow-lg tracking-tight font-serif">${movie.title}</h1>
                
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 text-sm text-textMuted mb-6 font-medium tracking-wide">
                  <span class="text-white">${movie.year}</span>
                  <span>•</span>
                  <span>${movie.runtime}</span>
                  <span>•</span>
                  <span>${movie.director}</span>
                </div>

                <!-- Action Bar (Glassmorphism) -->
                <div class="bg-[#1f252b]/60 backdrop-blur-md border border-white/5 rounded-xl p-4 mb-8 inline-flex flex-col sm:flex-row items-center gap-4 shadow-xl">
                   
                   <!-- Interactive Buttons -->
                   <div class="flex gap-3">
                      <button onclick="toggleAction(this, 'watched')" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-green-500/50 hover:bg-green-500/10 transition-all duration-300">
                        <svg class="w-5 h-5 text-textMuted group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span class="font-bold text-sm text-textMuted group-hover:text-white">Watch</span>
                      </button>

                      <button onclick="toggleAction(this, 'like')" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-pink-500/50 hover:bg-pink-500/10 transition-all duration-300">
                        <svg class="w-5 h-5 text-textMuted group-hover:text-pink-500 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657 3.172 10.828a4 4 0 010-5.656z"/></svg>
                        <span class="font-bold text-sm text-textMuted group-hover:text-white">Like</span>
                      </button>

                      <button onclick="toggleAction(this, 'watchlist')" class="group flex items-center gap-2 px-4 py-2 rounded-lg bg-[#14181c] border border-white/10 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all duration-300">
                         <svg class="w-5 h-5 text-textMuted group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z"></path></svg>
                         <span class="font-bold text-sm text-textMuted group-hover:text-white">Watchlist</span>
                      </button>
                   </div>

                   <div class="w-px h-8 bg-white/10 hidden sm:block"></div>

                   <!-- Rating -->
                   <div class="flex items-center gap-1">
                      <span class="text-xs uppercase font-bold text-textMuted mr-2">Rate</span>
                      <div class="flex text-gray-600 hover:text-primary transition-colors cursor-pointer" id="film-rating-stars">
                         ${[1,2,3,4,5].map(i => `
                           <svg onclick="rateMovie(this, ${i})" class="w-6 h-6 hover:text-primary hover:fill-current fill-transparent stroke-current transition-all duration-200" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                           </svg>
                         `).join('')}
                      </div>
                   </div>

                </div>

                <!-- Plot -->
                <h3 class="text-textMuted uppercase text-xs font-bold tracking-widest mb-2 border-b border-gray-800 pb-2 inline-block">Plot Summary</h3>
                <p class="text-lg leading-relaxed text-[#99aabb] font-serif max-w-2xl mx-auto md:mx-0">
                  ${movie.plot}
                </p>

                <!-- Genres -->
                 <div class="mt-6 flex flex-wrap justify-center md:justify-start gap-2">
                    ${movie.genres.map(g => `
                      <span class="px-3 py-1 rounded-full bg-[#2c3440] text-xs text-textLight font-medium border border-white/5 hover:bg-gray-700 cursor-pointer transition-colors">
                        ${g}
                      </span>
                    `).join('')}
                 </div>
              </div>
            </div>

            <!-- Cast & Tabs Placeholder -->
            <div class="mt-16 border-t border-gray-800 pt-8">
               <div class="flex gap-8 mb-6 border-b border-gray-800 text-sm font-bold uppercase tracking-widest">
                  <button class="pb-3 border-b-2 border-primary text-white">Cast</button>
                  <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">Crew</button>
                  <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">Details</button>
                  <button class="pb-3 border-b-2 border-transparent text-textMuted hover:text-white transition-colors">Reviews</button>
               </div>
               
               <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                  <!-- Mock Cast -->
                  ${[1,2,3,4,5,6].map(i => `
                    <div class="flex items-center gap-3 bg-[#1f252b] p-2 rounded border border-white/5">
                       <div class="w-10 h-10 bg-gray-700 rounded-full flex-shrink-0"></div>
                       <div class="overflow-hidden">
                          <p class="text-white text-xs font-bold truncate">Actor Name</p>
                          <p class="text-textMuted text-[10px] truncate">Character</p>
                       </div>
                    </div>
                  `).join('')}
               </div>
            </div>

          </div>
        </div>
@endsection