@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-8">ลงทะเบียนเป็นอาสาสมัคร</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('volunteer.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="skills" class="block text-sm font-medium text-gray-700">ทักษะ</label>
                <select id="skills" name="skills" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">เลือกทักษะ</option>
                    <option value="First Aid">การปฐมพยาบาล</option>
                    <option value="Teaching">การสอน</option>
                    <option value="Event Management">การจัดกิจกรรม</option>
                    <option value="Communication">การสื่อสาร</option>
                    <option value="Programming">การเขียนโปรแกรม</option>
                    <option value="Digital Marketing">การตลาดดิจิทัล</option>
                    <option value="Graphic Design">การออกแบบกราฟิก</option>
                    <option value="Health Support">การสนับสนุนด้านสุขภาพ</option>
                    <option value="Cooking">การทำอาหาร</option>
                    <option value="Counseling">การให้คำปรึกษา</option>
                </select>
                @error('skills')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="availability" class="block text-sm font-medium text-gray-700">ความพร้อมในการทำงาน</label>
                <select id="availability" name="availability" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">เลือกความพร้อม</option>
                    <option value="Every Day">ทุกวัน</option>
                    <option value="Monday - Friday">วันจันทร์ - วันศุกร์</option>
                    <option value="Saturday - Sunday">วันเสาร์ - วันอาทิตย์</option>
                    {{-- <option value="Morning">ช่วงเช้า</option>
                    <option value="Afternoon">ช่วงบ่าย</option>
                    <option value="Evening">ช่วงเย็น</option> --}}
                    <option value="On-Demand">ตามความต้องการ</option>
                </select>
                @error('availability')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    ลงทะเบียน
                </button>
            </div>
        </form>
    </div>
@endsection
