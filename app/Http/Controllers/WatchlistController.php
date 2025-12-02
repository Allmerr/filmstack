<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Http\Request;

class WatchlistController extends Controller
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
        if($request->input('alreadyInWatchlist') == '1') {
            $watchlistItem = \App\Models\Watchlist::where('users_id', auth()->id())
                ->where('id_films', $request->input('id_films'))
                ->first();
            if($watchlistItem) {
                $watchlistItem->delete();
                return redirect()->back()->with('success', 'Removed from watchlist successfully!');
            }
        }
        // Create a new Watchlist instance
        $watchlist = new Watchlist();
        $watchlist->users_id = auth()->id();
        $watchlist->id_films = $request->input('id_films');
        $watchlist->save();

        return redirect()->back()->with('success', 'Added to watchlist successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Watchlist $watchlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Watchlist $watchlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Watchlist $watchlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchlist $watchlist)
    {
        //
    }
}
