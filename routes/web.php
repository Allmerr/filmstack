<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchedController;
use App\Http\Controllers\LikedController;
use App\Models\Review;
use App\Models\Watched;
use App\Models\Liked;

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
        'reviews' => Review::where('id_films', $tittleId)->with('user')->get(),
        'watched' => Watched::where('id_films', $tittleId)->with('user')->get(),
        'liked' => Liked::where('id_films', $tittleId)->with('user')->get(),
    ]);
})->name('film');

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::post('watched', [WatchedController::class, 'store'])->name('watched.store')->middleware('auth');
Route::post('liked', [LikedController::class, 'store'])->name('liked.store')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LogoutController::class, 'index'])->name('logout')->middleware('auth');