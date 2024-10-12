@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">ผลการค้นหา</h1>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                @foreach ($news as $item)
                    <a href="{{ $item['url'] }}" class="block">
                        <div
                            class="bg-gray-50 px-6 py-4 border-b border-gray-200 hover:bg-gray-100 transition-colors duration-300">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900">{{ $item['title'] }}</h2>
                                <span
                                    class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($item['publishedAt'])->format('d M Y') }}</span>
                            </div>
                            <p class="mt-2 text-sm text-gray-700">
                                {{ Str::limit($item['description'], 150) }}
                            </p>
                            <span class="inline-block mt-3 text-blue-500 hover:text-blue-700 font-medium">อ่านต่อ</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
