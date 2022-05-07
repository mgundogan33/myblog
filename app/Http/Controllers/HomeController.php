<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments')->get();
        return view('home', [
            'posts' => $posts
        ]);
    }
}
