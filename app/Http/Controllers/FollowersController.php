<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;

class FollowersController extends Controller
{

    public function __construct()
    {
        // 关注功能必须登陆
        $this->middleware('auth');
    }


    public function store(User $user)
    {
        $this->authorize('follow',$user);
        if(!\Auth::user()->isFollowing($user->id)){
            \Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('follow',$user);
        if (\Auth::user()->isFollowing($user->id)) {
            \Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
