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

                
                <div class="bg-[#1f252b]/60 ... mb-8 inline-flex flex-col sm:flex-row items-center gap-4 shadow-xl">
                   <!-- ... tombol-tombol action ... -->
                   
                   <!-- HAPUS KODE MODAL DARI SINI -->
                   
                </div>

                {{-- ... sisa konten details (plot, genres) ... --}}
              </div>
            </div>

            <!-- Cast & Tabs Placeholder -->
            {{-- ... kode cast ... --}}

            <!-- Reviews Section -->
            <div class="mt-12">
                {{-- ... kode review ... --}}
            </div>

          </div> {{-- Tutup div max-w-5xl --}}
     </div> {{-- Tutup div fade-in --}}

     {{-- PASTE KODE MODAL DI SINI (Di luar layout utama tapi masih di dalam section content) --}}
     <div id="playlist-modal" class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closePlaylistModal()"></div>
        
        <!-- Card -->
        <div class="bg-[#1f252b] w-full max-w-md rounded-xl shadow-2xl border border-white/10 relative transform scale-95 transition-all duration-300 z-10 overflow-hidden mx-4">
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
                       <button onclick="createNewPlaylist('{{ $data['id'] }}')" class="bg-primary hover:bg-white text-darker font-bold text-sm px-4 rounded transition-colors whitespace-nowrap">Create</button>
                    </div>
              </div>
           </div>
        </div>
     </div>

@endsection

@push('js')
{{-- ... script JS ... --}}
@endpush