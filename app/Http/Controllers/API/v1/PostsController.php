<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }
    /**
     * Get all the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->query('sortByLatest') === "true") {
            $posts = Post::active()->orderByDesc('publication_date')->get();
        } else {
            $posts = Post::active()->orderBy('publication_date')->get();
        }

        return response()->json($posts, 200);
    }

    /**
     * Store New Post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePost(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'publication_date' => 'required'
            ]);

            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'publication_date' => Carbon::parse($request->publication_date),
                'status' => 1,
                'user_id' => auth()->user()->id,
            ]);

            $post->save();

            return response()->json('Post saved succesfully', 201);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Get User associated posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        $posts = auth()->user()->posts;

        return response()->json($posts, 200);
    }
}
