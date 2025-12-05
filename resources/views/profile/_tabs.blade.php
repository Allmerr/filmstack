<!-- Profile Tabs Partial -->
<div class="bg-[#14181c] border-b border-gray-800 sticky top-[72px] z-40">
    <div class="max-w-5xl mx-auto px-6 flex gap-8 text-sm font-bold uppercase tracking-widest overflow-x-auto">
        <a href="{{ route('profile.watched', ['username' => $user->username]) }}" class="py-4 border-b-2 {{ request()->routeIs('profile.watched') ? 'border-primary text-white' : 'border-transparent text-textMuted hover:text-white' }} transition-colors whitespace-nowrap">
            Watched <span class="text-xs text-gray-600 ml-1">{{ isset($watched) ? $watched->count() : 0 }}</span>
        </a>
        <a href="{{ route('profile.liked', ['username' => $user->username]) }}" class="py-4 border-b-2 {{ request()->routeIs('profile.liked') ? 'border-primary text-white' : 'border-transparent text-textMuted hover:text-white' }} transition-colors whitespace-nowrap">
            Likes <span class="text-xs text-gray-600 ml-1">{{ isset($liked) ? $liked->count() : 0 }}</span>
        </a>
        <a href="{{ route('profile.reviews', ['username' => $user->username]) }}" class="py-4 border-b-2 {{ request()->routeIs('profile.reviews') ? 'border-primary text-white' : 'border-transparent text-textMuted hover:text-white' }} transition-colors whitespace-nowrap">
            Reviews <span class="text-xs text-gray-600 ml-1">{{ isset($reviews) ? $reviews->count() : 0 }}</span>
        </a>
        <a href="{{ route('profile.watchlist', ['username' => $user->username]) }}" class="py-4 border-b-2 {{ request()->routeIs('profile.watchlist') ? 'border-primary text-white' : 'border-transparent text-textMuted hover:text-white' }} transition-colors whitespace-nowrap">
            Watchlist <span class="text-xs text-gray-600 ml-1">{{ isset($watchlist) ? $watchlist->count() : 0 }}</span>
        </a>
        <a href="{{ route('profile.playlists', ['username' => $user->username]) }}" class="py-4 border-b-2 {{ request()->routeIs('profile.playlists') ? 'border-primary text-white' : 'border-transparent text-textMuted hover:text-white' }} transition-colors whitespace-nowrap">
            Playlists <span class="text-xs text-gray-600 ml-1">{{ isset($playlists) ? $playlists->count() : $user->playlists()->count() }}</span>
        </a>
        <a href="{{ route('profile.followers', ['username' => $user->username]) }}" class="py-4 border-b-2 {{ request()->routeIs('profile.followers') ? 'border-primary text-white' : 'border-transparent text-textMuted hover:text-white' }} transition-colors whitespace-nowrap">
            Friends <span class="text-xs text-gray-600 ml-1">{{ $user->followers()->count() + $user->following()->count() }}</span>
        </a>
    </div>
</div>
