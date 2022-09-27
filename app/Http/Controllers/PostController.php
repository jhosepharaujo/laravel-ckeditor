<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{

    public function index($slug)
    {
        $post = Post::whereSlug($slug)->get()->first();
        return Inertia::render('Post/Index', ['post' => $post]);
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = \Str::slug($request->title);
        Post::create($data);
        return redirect()->route('post.create');
    }
}
