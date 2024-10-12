@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">ผลลัพธ์การค้นหา</h1>

        @if ($results)
            <ul class="space-y-2">
                @foreach ($results as $result)
                    <li class="border p-4 rounded">
                        <h2 class="text-lg font-semibold">{{ $result['name'] }}</h2>
                        <p>{{ $result['address'] }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>ไม่พบผลลัพธ์</p>
        @endif
    </div>
@endsection
