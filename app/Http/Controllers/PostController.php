<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:128',
            'location' => 'required|string|max:86',
            'body' => 'required|string',
            'image' => 'nullable|image',
        ]);

        if($validation->fails()) {
            return redirect('/home')
                ->withErrors($validation)
                ->withInput();
        }

        if($request->image != NULL) {
            $path = $request->file('image')->store('images');
        }
        else {
            $path = NULL;
        }

        $post = new Post;
        $post->title = trim($request->title);
        $post->location_id = $request->location;
        $post->body = trim($request->body);
        $post->img_url = $path;
        $post->user_id = Auth::user()->id;
        if ($post->save()) {
            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['user', 'comments.comments' => function ($query) {
            $query->with('user')->orderBy('votes');
        }])->where('thread_status', 1)->where('id', $id)->first();

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
