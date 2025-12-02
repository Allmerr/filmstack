<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
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
