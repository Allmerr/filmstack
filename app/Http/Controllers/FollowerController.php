<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
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
    public function following(Request $request)
    {
        if($request->input('alreadyFollowing') == '1') {
            $follow = \App\Models\Follower::where('users_id', auth()->id())
                ->where('following_to_users_id', $request->input('following_to_users_id'))
                ->first();
            if($follow) {
                $follow->delete();
                return redirect()->back()->with('success', 'Unfollowed successfully!');
            }
        }
        // Create a new Liked instance
        $follower = new Follower();
        $follower->users_id = auth()->id();
        $follower->following_to_users_id = $request->input('following_to_users_id');
        $follower->save();

        return redirect()->back()->with('success', 'User followed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Follower $follower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follower $follower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Follower $follower)
    {
        //
    }
}
