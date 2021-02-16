<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user_id= Auth::user()->id;
        $post = new Post();

//        error_log($request);

//        Post::updateOrCreate([
//            'post'=>$post
//        ],[
//            'user_id'=>$user_id,
//            'title' => $request->title,
//            'post' => $request->post,
//        ]);

        $post->fill([
            'user_id'=>$user_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        error_log($post);
        $post->save();

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user_id= Auth::user()->id;
        $post = Post::where('id', id);


        Post::updateOrCreate([
            'post'=>$post
            ],[
            'user_id'=>$user_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json(true);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPosts()
    {
        $posts = Post::latest('id')->get();

        return response()->json($posts);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(true);
    }
}
