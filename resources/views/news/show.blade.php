@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ $newsItem->title }}</h1>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <p class="text-gray-900">{{ $newsItem->content }}</p>
        </div>
    </div>

    <!-- Back to News List -->
    <div class="mt-4">
        <a href="{{ route('news') }}" class="text-blue-500 hover:text-blue-700">กลับไปที่หน้าข่าวสาร</a>
    </div>
</div>
@endsection
