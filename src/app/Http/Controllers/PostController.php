<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; // useする
use Illuminate\Http\Request;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->get()]);
    }

    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }

    public function create(Post $post)
    {
        return view('posts/create');
    }

    public function store(Post $post, Request $request) // 引数をRequestからPostRequestにする
    {
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id]; 
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
}