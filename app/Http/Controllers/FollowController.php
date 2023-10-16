<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;
use App\Models\Follow;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $following = auth()->user()->following;
        $followers = auth()->user()->followers;
    
        return Inertia::render('Follows/Index', [
            'following' => $following,
            'followers' => $followers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFollowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFollowRequest  $request
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFollowRequest $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        //
    }
    
    public function follow(User $user)
    {
        $follower_id = auth()->id();
    
        if (!$user->followers->contains($follower_id)) {
            Follow::create([
                'user_id' => $user->id,
                'follower_id' => $follower_id,
            ]);
        }
    
        return redirect()->back();
    }
    
    public function unfollow(User $user)
    {
        // DB::enableQueryLog();
    
        $follow = Follow::where('user_id', $user->id)
            ->where('follower_id', auth()->id())
            ->first();
    
        // $queries = DB::getQueryLog();
        // dd($queries);
            
    
        if ($follow) {
            $follow->delete();
        }
        
        // return response()->json(['status' => 'success']);
        return redirect()->back();
    }
}
