@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $safePlace->name }}</h1>

        <div class="mb-4">
            <p><strong class="font-semibold">ที่อยู่:</strong> {{ $safePlace->address }}</p>
            <p><strong class="font-semibold">เมือง:</strong> {{ $safePlace->city }}</p>
            <p><strong class="font-semibold">จังหวัด:</strong> {{ $safePlace->state }}</p>
            <p><strong class="font-semibold">Latitude:</strong> {{ $safePlace->latitude }}</p>
            <p><strong class="font-semibold">Longitude:</strong> {{ $safePlace->longitude }}</p>
            <p><strong class="font-semibold">รายละเอียด:</strong> {{ $safePlace->description }}</p>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-2">แผนที่</h2>
        <div class="overflow-hidden rounded-lg shadow-md">
            <iframe
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyChLse5DXerK5iubCdrSfI5p-K4AF0yhIU&q={{ $safePlace->latitude }},{{ $safePlace->longitude }}&zoom=15"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>

        <script>
            const mapLink =
                `https://www.google.com/maps/dir/?api=1&destination={{ $safePlace->latitude }},{{ $safePlace->longitude }}&destination=สถานที่ปลอดภัย`;
            document.write(
                `<a href="${mapLink}" class="inline-block mt-4 bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">ดูใน Google Maps</a>`
            );
        </script>

        <a href="{{ route('safe-places.index') }}"
            class="inline-block mt-4 bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700">กลับไปยังรายการสถานที่ปลอดภัย</a>
    </div>
@endsection
