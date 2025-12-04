<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchedController;
use App\Http\Controllers\LikedController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\RatedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\FollowerController;
use App\Models\Review;
use App\Models\Watched;
use App\Models\Liked;
use App\Models\Watchlist;
use App\Models\Rated;
use App\Models\FilmOfPlaylist;
use App\Models\User;

Route::get('/', function () {
    // Add a custom HTTP response header
    $response = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
    ])->get('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc');
    $data = $response->json(); // Get the JSON response as an array
    // if $data not available

    $films = $data['results'] ?? [];

    // Prepare local ratings map for these films
    $filmIds = array_values(array_filter(array_map(function($f){ return $f['id'] ?? null; }, $films)));
    $localRatings = [];
    if (!empty($filmIds)) {
        $grouped = Rated::whereIn('id_films', $filmIds)->get()->groupBy('id_films');
        foreach ($grouped as $id => $collection) {
            $count = $collection->count();
            $avg = round($collection->avg(function($r){ return (int) $r->rating; }), 1);
            $localRatings[$id] = ['avg' => $avg, 'count' => $count];
        }
    }

    return view('welcome', [
        'films' => $films,
        'localRatings' => $localRatings,
    ]);
})->name('welcome');

Route::get('/discover', function () {
    // Add a custom HTTP response header
    $response = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
    ])->get('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc');
    $data = $response->json(); // Get the JSON response as an array
    return view('discover', [
        'films' => $data['results'] ?? []
    ]);
})->name('discover');

Route::get('/film/{tittleId}', function ($tittleId) {
     $response = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
    ])->get("https://api.themoviedb.org/3/movie/{$tittleId}");

    // API response
    $data = $response->json();

    // Local ratings
    $ratedQuery = Rated::where('id_films', $tittleId)->with('user');
    $rated = $ratedQuery->get();
    $ratingCount = $ratedQuery->count();
    $avgRating = null;
    if ($ratingCount > 0) {
        $avgRating = round($rated->avg(function($r){ return (int) $r->rating; }), 1);
    }

    return view('film', [
        'data' => $data,
        'playlists' => auth()->check() ? auth()->user()->playlists : [],
        'reviews' => Review::where('id_films', $tittleId)->with('user')->get(),
        'watched' => Watched::where('id_films', $tittleId)->with('user')->get(),
        'liked' => Liked::where('id_films', $tittleId)->with('user')->get(),
        'watchlist' => Watchlist::where('id_films', $tittleId)->with('user')->get(),
        'filmOfPlaylists' => FilmOfPlaylist::where('id_films', $tittleId)->with('user')->get(),
        'rated' => $rated,
        'rating_count' => $ratingCount,
        'avg_rating' => $avgRating,
    ]);
})->name('film');

Route::get('/search', function () {
    $query = request('query');
    $response = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
    ])->get("https://api.themoviedb.org/3/search/movie?query={$query}&include_adult=false&language=en-US&page=1");
    
    $data = $response->json(); // Get the JSON response as an array
    // if $data not available
    if (!$data || !isset($data['results'])) {
        $data = ['results' => []];
    }

    $users = User::where('username', 'like', "%{$query}%")->get();
    foreach ($users as $user) {
        if($user->followers()->where('users_id', auth()->id())->exists()) {
            $user->alreadyFollowing = true;
        } else {
            $user->alreadyFollowing = false;
        }
    }

    return view('search', [
        'users' => $users,
        'films' => $data['results']
    ]);
})->name('search');

Route::post('/following', [FollowerController::class, 'following'])->name('following.store')->middleware('auth');

Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store')->middleware('auth');
Route::post('/playlists/add-film', [PlaylistController::class, 'addFilmToPlaylist'])->name('playlists.toggle')->middleware('auth');

Route::get('/profile/{username}/watched', [ProfileController::class, 'watched'])->name('profile.watched');
Route::get('/profile/{username}/liked', [ProfileController::class, 'liked'])->name('profile.liked');
Route::get('/profile/{username}/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');
Route::get('/profile/{username}/lists', [ProfileController::class, 'lists'])->name('profile.lists');
Route::get('/profile/{username}/watchlist', [ProfileController::class, 'watchlist'])->name('profile.watchlist');
Route::get('/profile/{username}/playlists', [ProfileController::class, 'playlists'])->name('profile.playlists');
Route::get('/profile/{username}/followers', [ProfileController::class, 'followers'])->name('profile.followers');

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::post('watched', [WatchedController::class, 'store'])->name('watched.store')->middleware('auth');
Route::post('liked', [LikedController::class, 'store'])->name('liked.store')->middleware('auth');
Route::post('watchlist', [WatchlistController::class, 'store'])->name('watchlist.store')->middleware('auth');
Route::post('rated', [RatedController::class, 'store'])->name('rated.store')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LogoutController::class, 'index'])->name('logout')->middleware('auth');