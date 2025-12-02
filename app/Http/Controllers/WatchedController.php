<?php

namespace App\Http\Controllers;

use App\Models\Watched;
use Illuminate\Http\Request;

class WatchedController extends Controller
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
        if($request->input('alreadyLiked') == '1') {
            $review = \App\Models\Watched::where('users_id', auth()->id())
                ->where('id_films', $request->input('id_films'))
                ->first();
            if($review) {
                $review->delete();
                return redirect()->back()->with('success', 'Review removed successfully!');
            }
        }
        // Create a new Watched instance
        $watched = new Watched();
        $watched->users_id = auth()->id();
        $watched->id_films = $request->input('id_films');
        $watched->save();

        return redirect()->back()->with('success', 'Film marked as watched!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Watched $watched)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Watched $watched)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Watched $watched)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watched $watched)
    {
        //
    }
}
