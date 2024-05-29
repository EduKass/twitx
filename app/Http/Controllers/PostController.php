<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the authenticated user's timeline with posts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('home', ['posts' => $posts]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // Create the post
        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        // Redirect back to the home page
        return redirect()->route('home')->with('status', 'Post created successfully!');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        $post->delete();
        return redirect()->route('home')->with('status', 'Post deleted successfully!');
    }
}
