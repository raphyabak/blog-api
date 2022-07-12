<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostEditResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        return PostResource::collection(Post::latest()->get());
    }

    public function store()
    {
        $post = Post::create([
            'title' => 'Untitled post',
        ]);

        return new PostResource($post);
    }

    public function edit(Post $post)
    {
        return new PostEditResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|string|unique:posts,slug,'.$post->id,
            'body' => 'nullable',
            'teaser' => 'nullable',
            'published' => 'boolean'
        ]);

        // $post->update($r);

        $post->update([
           'title' => $request->title,
           'body' => $request->body,
           'teaser' => $request->teaser,
           'published' => $request->published,
           'slug' => $request->slug,
        ]);


    }

    public function delete(Post $post){

        $post->delete();

    }

}
