<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if(\App\Models\Review::where('users_id', auth()->user()->id)->where('id_films', $request->input('id_films'))->exists()) {
            return redirect()->back()->with('error', 'You have already reviewed this film!');
        }
        // Validate the incoming request data
        $validated = $request->validate([
            'id_films' => 'required',
            'review' => 'required|string|max:1000',
        ]);
        
        // Create a new review
        $review = new \App\Models\Review();
        $review->users_id = auth()->user()->id;
        $review->id_films = $validated['id_films'];
        $review->review = $validated['review'];
        $review->save();
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Review added successfully!');
    }
}
