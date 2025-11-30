<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LogoutController::class, 'index'])->name('logout')->middleware('auth');