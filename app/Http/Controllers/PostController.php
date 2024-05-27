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
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);    }

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
    $post = new Post();
    $post->user_id = auth()->id(); // Get the authenticated user's ID
    $post->content = $request->input('content');
    $post->save();

    // Redirect back to the home page
    return redirect()->route('home');
}
    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('home');
    }
}
