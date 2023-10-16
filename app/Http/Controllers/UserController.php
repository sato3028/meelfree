<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(User $user)
    {
        $user->load('posts');
        $user->loadCount('posts');
        $user->loadCount(['following', 'followers']);
        
        return Inertia::render('Users/Index',[
                'user' => $user
            ]);
    }
}
