@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card รายงานระดับน้ำ -->
        <div class="card transition-transform transform hover:-translate-y-2 duration-300">
            <a href="{{ route('water-reports.index') }}"
                class="block h-64 p-6 bg-green-600 text-white rounded-lg shadow-lg hover:bg-green-700">
                <div class="flex flex-col justify-center items-center h-full">
                    <!-- ไอคอนน้ำ -->
                    <i class="fas fa-water text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold">รายงานระดับน้ำ</h3>
                    <p class="text-sm mt-4 text-center">ดูรายงานระดับน้ำในพื้นที่และติดตามสถานการณ์น้ำท่วม</p>
                </div>
            </a>
        </div>

        <!-- Card รายการขอความช่วยเหลือ -->
        <div class="card transition-transform transform hover:-translate-y-2 duration-300">
            <a href="{{ route('request.index') }}"
                class="block h-64 p-6 bg-yellow-600 text-white rounded-lg shadow-lg hover:bg-yellow-700">
                <div class="flex flex-col justify-center items-center h-full">
                    <!-- ไอคอนช่วยเหลือ -->
                    <i class="fas fa-hands-helping text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold">รายการขอความช่วยเหลือ</h3>
                    <p class="text-sm mt-4 text-center">ตรวจสอบและจัดการคำขอความช่วยเหลือในพื้นที่ของคุณ</p>
                </div>
            </a>
        </div>
    </div>
@endsection


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">




{{-- <a href="{{ route('water-resources') }}"
            class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-4">
            Go to Flood Information
        </a> --}}
