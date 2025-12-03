<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Review;
use App\Models\Watched;
use App\Models\Liked;
use App\Models\Watchlist;
use App\Models\Rated;


class ProfileController extends Controller
{
    public function watched($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $watched = Watched::where('users_id', $user->id)->get();
        foreach ($watched as $key => $watch) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$watch->id_films}");
            $watched[$key]->movie = $response->json();
        }
        foreach ($watched as $key => $watch) {
            $rated = Rated::where('users_id', $user->id)->where('id_films', $watch->id_films)->first();
            $watched[$key]->rated = $rated;
        }
        return view('profile.index', [
            'user' => $user,
            'reviews' => Review::where('users_id', $user->id)->with('user')->get(),
            'watched' => $watched,
            'liked' => Liked::where('users_id', $user->id)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $user->id)->with('user')->get(),
        ]);
    }

    public function liked($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $liked = Liked::where('users_id', $user->id)->get();
        foreach ($liked as $key => $like) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$like->id_films}");
            $liked[$key]->movie = $response->json();
        }
        foreach ($liked as $key => $like) {
            $rated = Rated::where('users_id', $user->id)->where('id_films', $like->id_films)->first();
            $liked[$key]->rated = $rated;
        }


        return view('profile.liked', [
            'user' => $user,
            'reviews' => Review::where('users_id', $user->id)->with('user')->get(),
            'watched' => Watched::where('users_id', $user->id)->with('user')->get(),
            'liked' => $liked,
            'watchlist' => Watchlist::where('users_id', $user->id)->with('user')->get(),
        ]);
    }

    public function reviews($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $review = Review::where('users_id', $user->id)->get();
        foreach ($review as $key => $like) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$like->id_films}");
            $review[$key]->movie = $response->json();
        }
        foreach ($review as $key => $like) {
            $rated = Rated::where('users_id', $user->id)->where('id_films', $like->id_films)->first();
            $review[$key]->rated = $rated;
        }


        return view('profile.review', [
            'user' => $user,
            'reviews' => $review,
            'watched' => Watched::where('users_id', $user->id)->with('user')->get(),
            'liked' => Liked::where('users_id', $user->id)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $user->id)->with('user')->get(),
        ]);
    }

    public function watchlist($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $watchlist = Watchlist::where('users_id', $user->id)->get();
        foreach ($watchlist as $key => $like) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$like->id_films}");
            $watchlist[$key]->movie = $response->json();
        }
        foreach ($watchlist as $key => $like) {
            $rated = Rated::where('users_id', $user->id)->where('id_films', $like->id_films)->first();
            $watchlist[$key]->rated = $rated;
        }


        return view('profile.watchlist', [
            'user' => $user,
            'reviews' => Review::where('users_id', $user->id)->with('user')->get(),
            'watched' => Watched::where('users_id', $user->id)->with('user')->get(),
            'liked' => Liked::where('users_id', $user->id)->with('user')->get(),
            'watchlist' => $watchlist,
        ]);
    }
}
