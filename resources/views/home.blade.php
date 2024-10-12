@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">ยินดีต้อนรับสู่ศูนย์กลางทรัพยากรสำหรับผู้ประสบภัยพิบัติ</h1>

        <!-- ข่าวสารล่าสุด -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">ข่าวสารล่าสุด</h3>
            </div>
            <div class="border-t border-gray-200">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', $item->id) }}" class="block">
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-100 transition-colors duration-300">
                            <div class="sm:col-span-1">
                                <h2 class="text-sm font-medium text-gray-500">{{ $item->title }}</h2>
                            </div>
                            <div class="sm:col-span-2 mt-2 sm:mt-0">
                                <p class="text-sm text-gray-900">
                                    {{ Str::limit($item->content, 100) }}
                                </p>
                                <span class="text-blue-500 hover:text-blue-700 mt-2 block">อ่านต่อ</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
