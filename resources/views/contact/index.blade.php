@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">ติดต่อเรา</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">ข้อความ</label>
                <textarea id="message" name="message" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                @error('message')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                    ส่งข้อความ
                </button>
            </div>
        </form>
    </div>
@endsection
