<?php

namespace App\Http\Controllers;

use App\Models\Post_comment;
use App\Http\Requests\StorePost_commentRequest;
use App\Http\Requests\UpdatePost_commentRequest;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('show', [
            'post_comments' => Post_comment::with('user')->latest()->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost_commentRequest $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->Post_comments()->create($validated);

        return redirect(route('show'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post_comment $post_comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post_comment $post_comment)
    {
        $this->authorize('update', $post_comment);

        return view('users.comment.edit', [
            'post_comment' => $post_comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePost_commentRequest $request, Post_comment $post_comment)
    {
        $this->authorize('update', $post_comment);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $post_comment->update($validated);

        return redirect(route('users.comment.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post_comment $post_comment)
    {
        $this->authorize('delete', $post_comment);

        $post_comment->delete();

        return redirect(route('users.comment.index'));
    }
}
