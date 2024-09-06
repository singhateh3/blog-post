<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userCount  = User::count();
        $postCount = Post::count();
        $authUserPosts = Auth::user()->posts;
        return view('dashboard', compact('userCount', 'postCount', 'authUserPosts'));
    }
}
