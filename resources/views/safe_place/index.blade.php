@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 px-4 sm:px-0">
        <h1 class="text-3xl font-bold mb-4">สถานที่ปลอดภัย</h1>
        <a href="{{ route('safe-places.create') }}"
            class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
            เพิ่มสถานที่ปลอดภัย
        </a>

        @if (session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center mb-4">
            <form action="{{ route('safe-places.search') }}" method="GET" class="flex space-x-2 w-full">
                <input type="text" name="query" placeholder="ค้นหาสถานที่ปลอดภัย"
                    class="border border-gray-300 px-4 py-2 rounded w-full" required>
                <button type="submit"
                    class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
                    ค้นหา
                </button>
            </form>
        </div>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ชื่อ</th>
                        <th class="py-3 px-6 text-left">ที่อยู่</th>
                        <th class="py-3 px-6 text-left">เมือง</th>
                        <th class="py-3 px-6 text-left">จังหวัด</th>
                        <th class="py-3 px-6 text-left">Latitude</th>
                        <th class="py-3 px-6 text-left">Longitude</th>
                        <th class="py-3 px-6 text-left">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($safePlaces as $safePlace)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">
                                <a href="{{ route('safe-places.show', $safePlace->id) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $safePlace->name }}
                                </a>
                            </td>
                            <td class="py-3 px-6">{{ $safePlace->address }}</td>
                            <td class="py-3 px-6">{{ $safePlace->city }}</td>
                            <td class="py-3 px-6">{{ $safePlace->state }}</td>
                            <td class="py-3 px-6">{{ $safePlace->latitude }}</td>
                            <td class="py-3 px-6">{{ $safePlace->longitude }}</td>
                            <td class="py-3 px-6">{{ $safePlace->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
