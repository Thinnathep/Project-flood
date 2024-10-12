@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">

        <a href="{{ route('water-resources') }}"
            class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-4">
            Go to Flood Information
        </a>

        <a href="{{ route('water-reports.index') }}"
            class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mb-4 ml-4">
            รายงานระดับน้ำ
        </a>

        <a href="{{ route('request.index') }}"
            class="inline-block px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 mb-4 ml-4">
            รายการขอความช่วยเหลือ <!-- ข้อความที่แสดง -->
        </a>

    </div>
@endsection
