@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('forum.index') }}" class="text-blue-600 hover:underline">ย้อนกลับไปยังฟอรั่ม</a>
        </div>

        <!-- Title Section -->
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">{{ $post->title }}</h1>

        <!-- Post Content Section -->
        <div class="bg-white shadow-lg rounded-lg mb-8 p-6">
            <p class="text-gray-700 leading-relaxed">{{ $post->content }}</p>
        </div>

        @auth
            <!-- Comment Form -->
            <form action="{{ route('forum.comments.store', $post->id) }}" method="POST"
                class="bg-white shadow-lg rounded-lg p-6 mb-8">
                @csrf
                <textarea name="content" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 resize-none"
                    placeholder="แสดงความคิดเห็น..."></textarea>
                <button type="submit"
                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">ส่งความคิดเห็น</button>
            </form>
        @endauth

        <!-- Comments Section -->
        <div class="bg-white shadow-lg rounded-lg">
            @if ($post->comments->isNotEmpty())
                <div class="border-t border-gray-200">
                    <dl>
                        @foreach ($post->comments as $comment)
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <div class="font-semibold text-gray-700">{{ $comment->user->name }}</div>
                                <p class="text-gray-600 mt-1">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </dl>
                </div>
            @else
                <p class="text-gray-500 text-center mt-4 py-4">ยังไม่มีความคิดเห็น</p>
            @endif
        </div>
    </div>
@endsection
