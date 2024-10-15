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
            // Load posts with likes and comments
            $posts = ForumPost::with(['likes', 'comments.user'])->latest()->paginate(5);

            // Render HTML view for posts
            $html = view('forum.partials.posts', compact('posts'))->render();

            // Return HTML along with total likes
            return response()->json([
                'html' => $html,
                'totalLikes' => $posts->sum(function ($post) {
                    return $post->likes->count();
                })
            ]);
        }

        // For initial page load
        $posts = ForumPost::with(['likes', 'comments.user'])->latest()->paginate(10);
        return view('forum.index', compact('posts'));
    }



    public function show($id)
    {
        $post = ForumPost::with('comments.user')->findOrFail($id);

        // อัปเดตจำนวนการเข้าชม
        $post->increment('views_count');

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ตรวจสอบรูปภาพ
        ]);

        $imagePath = null;

        // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
        if ($request->hasFile('image')) {
            // อัปโหลดรูปภาพ
            $imagePath = $request->file('image')->store('forum_images', 'public'); // บันทึกรูปภาพใน storage
        }

        // สร้างโพสต์ใหม่
        ForumPost::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath, // บันทึกพาธรูปภาพ
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
        } else {
            // User has not liked the post yet, so we create a new like
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $postId
            ]);
        }

        // คำนวณจำนวนไลค์ปัจจุบัน
        $likeCount = $post->likes()->count();

        return response()->json([
            'message' => $like ? 'Post unliked successfully' : 'Post liked successfully',
            'likeCount' => $likeCount,
        ]);
    }

    public function edit($id)
    {
        $post = ForumPost::findOrFail($id); // ค้นหาโพสต์ตาม ID

        return view('forum.edit', compact('post')); // โหลดวิวยูที่ใช้สำหรับแก้ไข
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ตรวจสอบรูปภาพ
        ]);

        $post = ForumPost::findOrFail($id); // ค้นหาโพสต์ตาม ID

        // อัปเดตโพสต์
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
        if ($request->hasFile('image')) {
            // อัปโหลดรูปภาพ
            $imagePath = $request->file('image')->store('forum_images', 'public'); // บันทึกรูปภาพใน storage
            $post->image = $imagePath; // บันทึกพาธรูปภาพ
            $post->save(); // บันทึกการเปลี่ยนแปลง
        }

        return redirect()->route('forum.index')->with('success', 'โพสต์ถูกอัปเดตเรียบร้อยแล้ว!');
    }



    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'โพสต์ถูกลบเรียบร้อยแล้ว']);
    }


}
