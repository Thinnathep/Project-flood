@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-6">แก้ไขโพสต์</h1>

        <form action="{{ route('forum.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- ใช้ PUT สำหรับการอัปเดต -->

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">หัวข้อ:</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">เนื้อหา:</label>
                <textarea name="content" id="content"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500"
                    required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">อัปโหลดรูปภาพ:</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="mt-2 rounded-lg"
                        style="max-width: 150px;">
                @endif
            </div>

            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">อัปเดตโพสต์</button>
            </div>
        </form>
    </div>
@endsection
