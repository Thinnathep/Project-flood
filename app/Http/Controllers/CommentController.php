<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ForumPost;

class CommentController extends Controller
{
    public function store(Request $request, ForumPost $forumPost)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->forum_post_id = $forumPost->id;
        $comment->user_id = auth()->id();
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('forum.show', ['id' => $forumPost->id])->with('success', 'Comment added!');
    }
}
