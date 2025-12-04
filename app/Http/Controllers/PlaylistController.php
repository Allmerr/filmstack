<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
