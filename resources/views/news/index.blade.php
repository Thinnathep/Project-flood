@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">ข่าวสาร</h1>

        <form action="{{ route('news.search') }}" method="GET" class="mb-6">
            <input type="text" name="query" placeholder="ค้นหาข่าว..." class="border p-2 rounded w-full">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-2">ค้นหา</button>
        </form>


        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', $item->id) }}" class="block">
                        <div
                            class="bg-gray-50 px-6 py-4 border-b border-gray-200 hover:bg-gray-100 transition-colors duration-300">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900">{{ $item->title }}</h2>
                                <span class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                            <p class="mt-2 text-sm text-gray-700">
                                {{ Str::limit($item->content, 150) }}
                            </p>
                            <span class="inline-block mt-3 text-blue-500 hover:text-blue-700 font-medium">อ่านต่อ</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $news->links() }}
        </div>
    </div>
@endsection
