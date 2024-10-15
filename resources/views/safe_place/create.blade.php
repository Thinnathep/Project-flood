@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 px-4 sm:px-0">
        <h1 class="text-3xl font-bold mb-6">เพิ่มสถานที่ปลอดภัย</h1>

        <form action="{{ route('safe-places.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">ชื่อ</label>
                <input type="text" name="name" class="form-control border border-gray-300 rounded py-2 px-3 w-full"
                    id="name" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">ที่อยู่</label>
                <input type="text" name="address" class="form-control border border-gray-300 rounded py-2 px-3 w-full"
                    id="address" required>
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">เมือง</label>
                <input type="text" name="city" class="form-control border border-gray-300 rounded py-2 px-3 w-full"
                    id="city" required>
            </div>
            <div class="mb-4">
                <label for="state" class="block text-gray-700 text-sm font-bold mb-2">รัฐ</label>
                <input type="text" name="state" class="form-control border border-gray-300 rounded py-2 px-3 w-full"
                    id="state" required>
            </div>
            <div class="mb-4">
                <label for="latitude" class="block text-gray-700 text-sm font-bold mb-2">Latitude</label>
                <input type="text" name="latitude" class="form-control border border-gray-300 rounded py-2 px-3 w-full"
                    id="latitude" required>
            </div>
            <div class="mb-4">
                <label for="longitude" class="block text-gray-700 text-sm font-bold mb-2">Longitude</label>
                <input type="text" name="longitude" class="form-control border border-gray-300 rounded py-2 px-3 w-full"
                    id="longitude" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">รายละเอียด</label>
                <textarea name="description" class="form-control border border-gray-300 rounded py-2 px-3 w-full" id="description"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
                บันทึก
            </button>
        </form>
    </div>
@endsection
