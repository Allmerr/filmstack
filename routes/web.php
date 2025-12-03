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
use App\Models\Review;
use App\Models\Watched;
use App\Models\Liked;
use App\Models\Watchlist;
use App\Models\Rated;

Route::get('/', function () {
    $response = Http::get('https://api.imdbapi.dev/titles');
    $data = $response->json(); // Get the JSON response as an array
    // if $data not available
    if (!$data || !isset($data['titles'])) {
        $data = ['titles' => []];
    }

    return view('welcome', [
        'data' => array_slice($data['titles'], 0, 20)
    ]);
})->name('welcome');

Route::get('/film/{tittleId}', function ($tittleId) {
    $response = Http::get("https://api.imdbapi.dev/titles/{$tittleId}");

    return view('film', [
        'data' => $response->json(),
        'playlists' => auth()->check() ? auth()->user()->playlists : [],
        'reviews' => Review::where('id_films', $tittleId)->with('user')->get(),
        'watched' => Watched::where('id_films', $tittleId)->with('user')->get(),
        'liked' => Liked::where('id_films', $tittleId)->with('user')->get(),
        'watchlist' => Watchlist::where('id_films', $tittleId)->with('user')->get(),
        'rated' => Rated::where('id_films', $tittleId)->with('user')->get(),
    ]);
})->name('film');

Route::get('/search', function () {
    $query = request('query');
    $response = Http::get("https://api.imdbapi.dev/search/titles?query={$query}");
    $data = $response->json(); // Get the JSON response as an array
    // if $data not available
    if (!$data || !isset($data['titles'])) {
        $data = ['titles' => []];
    }

    return view('search', [
        'films' => $data['titles']
    ]);
})->name('search');

Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store')->middleware('auth');
Route::post('/playlists/add-film', [PlaylistController::class, 'addFilmToPlaylist'])->name('playlists.toggle')->middleware('auth');

Route::get('/profile/{username}/watched', [ProfileController::class, 'watched'])->name('profile.watched');
Route::get('/profile/{username}/liked', [ProfileController::class, 'liked'])->name('profile.liked');
Route::get('/profile/{username}/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');
Route::get('/profile/{username}/lists', [ProfileController::class, 'lists'])->name('profile.lists');
Route::get('/profile/{username}/watchlist', [ProfileController::class, 'watchlist'])->name('profile.watchlist');

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