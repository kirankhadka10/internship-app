<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        
        return view('home',compact('posts'));
    }

    public function create(){
        return view('frontend.posts.create');
    }

    public function show($id)
    {
        
        $post = Post::findOrFail($id);
        
        return view('frontend.posts.show',compact('post'));
    }

    public function store(Request $request)
    {
        $post = $request->validate([
            'title' =>  ['required'],
            'body'  =>  ['required'],
            'user_id'   =>  ['required', 'exists:users,id'],
        ]);
        
        Post::create($post);

        return redirect()->route('home');

    }
}
