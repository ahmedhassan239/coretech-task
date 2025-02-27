<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Jobs\NotifyAdminsNewPostJob;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use NotifyAdminsNewPostJob;

class PostController extends Controller
{
    public function store(PostRequest $request)
    {
        $post = $request->user()->posts()->create([
            'title' => $request->validated('title'),
            'content' => $request->validated('content'),
            'status' => 'pending'
        ]);

        NotifyAdminsNewPostJob::dispatch($post);

        return new PostResource($post);
    }
    
    

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['user', 'categories', 'comments']));
    }
}
