<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\FilmOfPlaylist;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::with(['user', 'filmofplaylists'])->paginate(12);
        $this->hydratePosters($playlists);

        return view('playlists.index', [
            'playlists' => $playlists,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist = new Playlist();
        $playlist->users_id = auth()->id();
        $playlist->name = $request->input('name');
        $playlist->description = $request->input('description', null);
        $playlist->save();

        return redirect()->back()->with('success', 'Playlist created successfully.');
    }

    public function addFilmToPlaylist(Request $request)
    {
        // if already in playlist, delete from playlist
        $existingEntry = \App\Models\FilmOfPlaylist::where('users_id', auth()->id())
            ->where('playlists_id', $request->input('playlist_id'))
            ->where('id_films', $request->input('id_films'))
            ->first();
        if ($existingEntry) {
            $existingEntry->delete();
            return redirect()->back()->with('success', 'Film removed from playlist successfully.');
        }


        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'id_films' => 'required|string|max:255',
        ]);

        $filmOfPlaylist = new \App\Models\FilmOfPlaylist();
        $filmOfPlaylist->users_id = auth()->id();
        $filmOfPlaylist->playlists_id = $request->input('playlist_id');
        $filmOfPlaylist->id_films = $request->input('id_films');
        $filmOfPlaylist->save();
        
        return redirect()->back()->with('success', 'Film added to playlist successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        // Load related films
        $playlist->load('filmofplaylists');

        // Fetch poster_path for each film from TMDB
        foreach ($playlist->filmofplaylists as $key => $film) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
            ])->get("https://api.themoviedb.org/3/movie/{$film->id_films}");

            if ($response->ok()) {
                $playlist->filmofplaylists[$key]->poster_path = $response->json()['poster_path'] ?? null;
                $playlist->filmofplaylists[$key]->title = $response->json()['title'] ?? null;
                $playlist->filmofplaylists[$key]->vote_average = $response->json()['vote_average'] ?? null;
                $playlist->filmofplaylists[$key]->vote_count = $response->json()['vote_count'] ?? null;
            }
        }

        return view('playlists.show', [
            'playlist' => $playlist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove a film from the playlist.
     */
    public function removeFilm(Playlist $playlist, $filmId)
    {
        if (auth()->id() !== $playlist->users_id) {
            abort(403, 'Unauthorized');
        }

        FilmOfPlaylist::where('playlists_id', $playlist->id)
            ->where('id_films', $filmId)
            ->where('users_id', auth()->id())
            ->delete();

        return redirect()->back()->with('success', 'Film removed from playlist.');
    }

    /**
     * Hydrate poster and title for up to 3 films in each playlist for preview.
     */
    private function hydratePosters($playlists)
    {
        foreach ($playlists as $playlist) {
            foreach ($playlist->filmofplaylists->take(3) as $key => $film) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MjA5MDZjY2I2MjAyMmI1YTRhYTk0NDNmMzIyZTVjOSIsIm5iZiI6MTc2NDQ4NzgyMS4wMTcsInN1YiI6IjY5MmJmMjhkM2ViYWNhZjQ1OTI0ZjAwNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.JfScCkisoJ0WsY70j7B-rjrrHGo7vppce7j2CfcwEs8'
                ])->get("https://api.themoviedb.org/3/movie/{$film->id_films}");

                if ($response->ok()) {
                    $playlist->filmofplaylists[$key]->poster_path = $response->json()['poster_path'] ?? null;
                    $playlist->filmofplaylists[$key]->title = $response->json()['title'] ?? null;
                }
            }
        }
    }
}
