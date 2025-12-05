<?php

namespace App\Http\Controllers;

use App\Models\Rated;
use Illuminate\Http\Request;

class RatedController extends Controller
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
        // Validate the rating input
        $validated = $request->validate([
            'rating' => 'required|in:1,2,3,4,5',
            'id_films' => 'required',
        ]);

        // if the user has already rated this film, update the rating
        $existingRating = Rated::where('users_id', auth()->id())
            ->where('id_films', $validated['id_films'])
            ->first();

        if ($existingRating) {
            $existingRating->rating = $validated['rating'];
            $existingRating->save();
            return redirect()->back()->with('success', 'Film rating updated successfully!');
        }

        // Create a new Rated instance
        $rated = new Rated();
        $rated->users_id = auth()->id();
        $rated->id_films = $validated['id_films'];
        $rated->rating = $validated['rating'];
        $rated->save();

        return redirect()->back()->with('success', 'Film rated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rated $rated)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rated $rated)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rated $rated)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rated $rated)
    {
        //
    }
}
