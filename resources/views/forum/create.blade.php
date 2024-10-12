<!-- resources/views/forum/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">สร้างโพสต์ใหม่</h1>

        <form action="{{ route('forum.store') }}" method="POST" class="bg-white shadow sm:rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">หัวข้อ</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">เนื้อหา</label>
                <textarea name="content" id="content" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">สร้างโพสต์</button>
        </form>
    </div>
@endsection
