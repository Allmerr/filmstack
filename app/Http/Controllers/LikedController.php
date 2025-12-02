<?php

namespace App\Http\Controllers;

use App\Models\Liked;
use Illuminate\Http\Request;

class LikedController extends Controller
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
            $like = \App\Models\Liked::where('users_id', auth()->id())
                ->where('id_films', $request->input('id_films'))
                ->first();
            if($like) {
                $like->delete();
                return redirect()->back()->with('success', 'Like removed successfully!');
            }
        }
        // Create a new Liked instance
        $liked = new Liked();
        $liked->users_id = auth()->id();
        $liked->id_films = $request->input('id_films');
        $liked->save();

        return redirect()->back()->with('success', 'Film liked successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Liked $liked)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liked $liked)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liked $liked)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liked $liked)
    {
        //
    }
}
