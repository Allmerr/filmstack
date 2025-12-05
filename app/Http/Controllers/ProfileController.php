<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Review;
use App\Models\Watched;
use App\Models\Liked;
use App\Models\Watchlist;
use App\Models\Rated;
use App\Models\Playlist;
use App\Models\Follower;


class ProfileController extends Controller
{
    public function watched($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $watched = Watched::where('users_id', $user->id)->get();
        foreach ($watched as $key => $watch) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
            ])->get("https://api.themoviedb.org/3/movie/{$watch->id_films}");
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
            'playlists' => Playlist::where('users_id', $user->id)->with('filmofplaylists')->get(),
            'followers' => $user->followers()->count(),
        ]);
    }

    public function liked($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $liked = Liked::where('users_id', $user->id)->get();
        foreach ($liked as $key => $like) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
            ])->get("https://api.themoviedb.org/3/movie/{$like->id_films}");
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
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
            ])->get("https://api.themoviedb.org/3/movie/{$like->id_films}");
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
            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
            ])->get("https://api.themoviedb.org/3/movie/{$like->id_films}");
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

    public function playlists($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $playlists = Playlist::where('users_id', $user->id)->with('filmofplaylists')->get();
        // get film data for each FilmOfPlaylist in the playlists
        foreach ($playlists as $playlist) {
            foreach ($playlist->filmofplaylists as $key => $film) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
                ])->get("https://api.themoviedb.org/3/movie/{$film->id_films}");
                $playlist->filmofplaylists[$key]->poster_path = $response->json()['poster_path'];
            }
        }
        return view('profile.playlists', [
            'user' => $user,
            'playlists' => $playlists,
            'reviews' => Review::where('users_id', $user->id)->with('user')->get(),
            'watched' => Watched::where('users_id', $user->id)->with('user')->get(),
            'liked' => Liked::where('users_id', $user->id)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $user->id)->with('user')->get(),
        ]);
    }

    public function followers($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        
        // Get users who follow this user (followers)
        $followers = Follower::where('following_to_users_id', $user->id)->with('user')->get();
        
        // Get users that this user follows (following)
        $following = Follower::where('users_id', $user->id)->with(['followingUser'])->get();

        return view('profile.followers', [
            'user' => $user,
            'followers' => $followers,
            'following' => $following,
            'reviews' => Review::where('users_id', $user->id)->with('user')->get(),
            'watched' => Watched::where('users_id', $user->id)->with('user')->get(),
            'liked' => Liked::where('users_id', $user->id)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $user->id)->with('user')->get(),
            'playlists' => Playlist::where('users_id', $user->id)->with('filmofplaylists')->get(),
        ]);
    }

    public function following($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $followers = $user->followers()->get();
        $following = $user->following()->get();

        return view('profile.following', [
            'user' => $user,
            'followers' => $followers,
            'following' => $following,
            'reviews' => Review::where('users_id', $user->id)->with('user')->get(),
            'watched' => Watched::where('users_id', $user->id)->with('user')->get(),
            'liked' => Liked::where('users_id', $user->id)->with('user')->get(),
            'watchlist' => Watchlist::where('users_id', $user->id)->with('user')->get(),
            'playlists' => Playlist::where('users_id', $user->id)->with('filmofplaylists')->get(),
        ]);
    }

    public function update(Request $request, $username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        if ($request->file('avatar')) {
            $rules['avatar'] = 'required|image|mimes:jpeg,png,jpg';
        }
        // Ensure the authenticated user is the owner of the profile
        if (auth()->id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:500',
        ]);
        
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($user->avatar) {
                \Illuminate\Support\Facades\Storage::delete('profile/' . $user->avatar, 'public');
            }
            
            // Simpan foto baru dan simpan nama file di database
            $avatarPath = $request->file('avatar')->store('profile', 'public');
            $user->update([
                'avatar' => str_replace('profile/', '', $avatarPath)
            ]);
        }

        // Update user profile
        $user->update($validatedData);
        
        return redirect()->route('profile.watched', ['username' => $user->username])->with('success', 'Profile updated successfully.');
    }
}
