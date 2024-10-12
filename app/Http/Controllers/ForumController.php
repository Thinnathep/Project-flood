<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\Likecount;
use Illuminate\Http\Request;
use App\Models\Like;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = ForumPost::latest()->paginate(5);
            $posts = ForumPost::with(['likes'])->paginate(5); // โหลดโพสต์พร้อมไลค์
            $html = view('forum.partials.posts', compact('posts'))->render();
            return response()->json(['html' => $html]);
        }


        $posts = ForumPost::latest()->paginate(10);
        return view('forum.index', compact('posts'));
    }



    public function show($id)
    {
        $post = ForumPost::with('comments.user')->findOrFail($id);
        return view('forum.show', compact('post'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ForumPost::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index')->with('success', 'โพสต์ใหม่ถูกสร้างแล้ว!');
    }

    public function likePost($postId)
    {
        $post = ForumPost::find($postId);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Check if user already liked the post
        $like = Like::where('user_id', auth()->id())
            ->where('post_id', $postId)
            ->first();

        if ($like) {
            // User has already liked the post, so we delete the like
            $like->delete();
            return response()->json(['message' => 'Post unliked successfully']);
        } else {
            // User has not liked the post yet, so we create a new like
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $postId
            ]);
            return response()->json(['message' => 'Post liked successfully']);
        }
    }

}
