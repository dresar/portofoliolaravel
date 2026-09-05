<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog', [
            'posts' => Post::published()->orderBy('published_at', 'desc')->paginate(9),
        ]);
    }

    public function show(Post $post)
    {
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }
        
        return view('blog.show', compact('post'));
    }
}

