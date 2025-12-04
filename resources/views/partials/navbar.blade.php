<!-- Navbar -->
    <nav class="bg-darker border-b border-gray-800 px-4 md:px-6 py-4 sticky top-0 z-50">
      <div class="max-w-5xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-8">
          <a href="{{ route('welcome') }}" class="flex items-center gap-2 group">
            <div class="w-6 h-6 grid grid-cols-2 gap-0.5">
               <div class="bg-white rounded-full opacity-90 group-hover:bg-primary transition-colors"></div>
               <div class="bg-white rounded-full opacity-60 group-hover:bg-primary transition-colors"></div>
               <div class="bg-white rounded-full opacity-70 group-hover:bg-primary transition-colors"></div>
               <div class="bg-none"></div> 
            </div>
            <span class="text-sm font-bold uppercase text-white tracking-wide">Filmstack</span>
          </a>
          
          <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-textMuted uppercase tracking-wider">
            @guest
            <a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a>
            <a href="{{ route('register') }}" class="hover:text-white transition-colors">Create Account</a>
            @endguest
            @auth
            <a href="{{ route('profile.watched', ['username' => auth()->user()->username]) }}" class="hover:text-white transition-colors">Profile</a>
            <a href="#" class="hover:text-white transition-colors">Journal</a>
            @endauth
            <a href="#" class="hover:text-white transition-colors">Films</a>
            <a href="#" class="hover:text-white transition-colors">Lists</a>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <!-- Search (Hidden on mobile) -->
          <div class="hidden sm:block relative">
            <form action="{{ route('search') }}" method="get">
              <div class="flex items-between">
                <input 
                    type="text" 
                    placeholder="Search films friends and more..." 
                    class="bg-surface text-white text-sm rounded-full px-4 py-2 w-64 focus:outline-none focus:ring-1 focus:ring-primary placeholder-gray-500"
                    name="query"
                    value="{{ request('query') }}"
                  />
                  <button type="submit" class="hidden absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 hover:text-white focus:outline-none" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                    </svg>
                  </button>
              </div>
            </form>
          </div>

          <!-- logout -->
          @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-textMuted hover:text-white transition-colors text-sm font-semibold uppercase tracking-wider">
              Logout
            </button>
          </form>
          @endauth

          <!-- Mobile Menu Button -->
          <button id="mobile-menu-btn" class="text-white md:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 z-[100] bg-darker/95 backdrop-blur-sm hidden flex-col p-6 transition-all duration-300">
        <div class="flex justify-between items-center mb-8">
            <span class="text-xl font-bold text-white">Menu</span>
            <!-- Close Button -->
            <button id="mobile-menu-close" class="text-textMuted hover:text-white p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Mobile Search -->
        <div class="mb-8">
             <form action="{{ route('search') }}" method="get">
                <input 
                    type="text" 
                    placeholder="Search films..." 
                    class="bg-surface text-white text-lg rounded-md px-4 py-3 w-full focus:outline-none focus:ring-1 focus:ring-primary placeholder-gray-500"
                    name="query"
                    value="{{ request('query') }}"
                />
                <button type="submit" class="hidden absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 hover:text-white focus:outline-none" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                    </svg>
                  </button>
             </form>
        </div>

        <nav class="flex flex-col gap-6 text-xl font-bold text-textMuted">
            @guest
            <a href="{{ route('login') }}" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Sign In <span>&rarr;</span>
            </a>
            <a href="{{ route('register') }}" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Create Account <span>&rarr;</span>
            </a>
            @endguest
            @auth
            <a href="{{ route('profile.watched', ['username' => auth()->user()->username]) }}" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Profile <span>&rarr;</span>
            </a>
            @endauth
            <a href="#" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Films
            </a>
            <a href="#" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Lists
            </a>
            <a href="#" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Members
            </a>
            @auth
            <a href="#" class="hover:text-primary transition-colors flex items-center justify-between border-b border-gray-800 pb-2">
                Journal
            </a>
            @endauth
        </nav>
    </div>  