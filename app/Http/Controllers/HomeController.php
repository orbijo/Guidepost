<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['user', 'comments.comments' => function ($query) {
            $query->with('user')->orderBy('votes')->take(3);
        }])->where('thread_status', 1)->orderBy('updated_at', 'desc')->get();
        
        return view('home', ['posts' => $posts]);
    }
}
