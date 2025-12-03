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
        $id_user = \App\Models\User::where('username', $username)->firstOrFail()->id;
        $watched = Watched::where('users_id', $id_user)->get();
        foreach ($watched as $key => $watch) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$watch->id_films}");
            $watched[$key]->movie = $response->json();
        }
        foreach ($watched as $key => $watch) {
            $rated = Rated::where('users_id', $id_user)->where('id_films', $watch->id_films)->first();
            $watched[$key]->rated = $rated;
        }

        return view('profile.index', [
            'reviews' => Review::where('users_id', $id_user)->with('user')->get(),
            'watched' => $watched,
            'liked' => Liked::where('users_id', $id_user)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $id_user)->with('user')->get(),
        ]);
    }

    public function liked($username)
    {
        $id_user = \App\Models\User::where('username', $username)->firstOrFail()->id;
        $liked = Liked::where('users_id', $id_user)->get();
        foreach ($liked as $key => $like) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$like->id_films}");
            $liked[$key]->movie = $response->json();
        }
        foreach ($liked as $key => $like) {
            $rated = Rated::where('users_id', $id_user)->where('id_films', $like->id_films)->first();
            $liked[$key]->rated = $rated;
        }


        return view('profile.liked', [
            'reviews' => Review::where('users_id', $id_user)->with('user')->get(),
            'watched' => Watched::where('users_id', $id_user)->with('user')->get(),
            'liked' => $liked,
            'watchlist' => Watchlist::where('users_id', $id_user)->with('user')->get(),
        ]);
    }

    public function reviews($username)
    {
        $id_user = \App\Models\User::where('username', $username)->firstOrFail()->id;
        $review = Review::where('users_id', $id_user)->get();
        foreach ($review as $key => $like) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$like->id_films}");
            $review[$key]->movie = $response->json();
        }
        foreach ($review as $key => $like) {
            $rated = Rated::where('users_id', $id_user)->where('id_films', $like->id_films)->first();
            $review[$key]->rated = $rated;
        }


        return view('profile.review', [
            'reviews' => $review,
            'watched' => Watched::where('users_id', $id_user)->with('user')->get(),
            'liked' => Liked::where('users_id', $id_user)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $id_user)->with('user')->get(),
        ]);
    }

    public function watchlist($username)
    {
        $id_user = \App\Models\User::where('username', $username)->firstOrFail()->id;
        $watchlist = Watchlist::where('users_id', $id_user)->get();
        foreach ($watchlist as $key => $like) {
            $response = Http::get("https://api.imdbapi.dev/titles/{$like->id_films}");
            $watchlist[$key]->movie = $response->json();
        }
        foreach ($watchlist as $key => $like) {
            $rated = Rated::where('users_id', $id_user)->where('id_films', $like->id_films)->first();
            $watchlist[$key]->rated = $rated;
        }


        return view('profile.watchlist', [
            'reviews' => Review::where('users_id', $id_user)->with('user')->get(),
            'watched' => Watched::where('users_id', $id_user)->with('user')->get(),
            'liked' => Liked::where('users_id', $id_user)->with('user')->get(),
            'watchlist' => $watchlist,
        ]);
    }
}
