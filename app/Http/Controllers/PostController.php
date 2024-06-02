<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostCreated;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate(['content' => 'required']);
        $post = $request->user()->posts()->create($request->all());
        broadcast(new PostCreated($post))->toOthers();
        return redirect()->back();
    }


}