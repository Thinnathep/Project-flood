@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">รายงานระดับน้ำ</h2>
        <form action="{{ route('water-reports.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="location" class="block mb-2">สถานที่</label>
                <input type="text" name="location" id="location" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="water_source_type" class="block mb-2">ประเภทแหล่งน้ำ</label>
                <select name="water_source_type" id="water_source_type" class="w-full px-3 py-2 border rounded" required>
                    <option value="river">แม่น้ำ</option>
                    <option value="flood_area">พื้นที่น้ำท่วม</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="water_source_name" class="block mb-2">ชื่อแหล่งน้ำ</label>
                <input type="text" name="water_source_name" id="water_source_name"
                    class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="water_level" class="block mb-2">ระดับน้ำ (เมตร)</label>
                <input type="number" step="0.01" name="water_level" id="water_level"
                    class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-2">รายละเอียดเพิ่มเติม</label>
                <textarea name="description" id="description" class="w-full px-3 py-2 border rounded" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="status" class="block mb-2">สถานะ</label>
                <select name="status" id="status" class="w-full px-3 py-2 border rounded" required>
                    <option value="normal">ปกติ</option>
                    <option value="warning">เฝ้าระวัง</option>
                    <option value="danger">อันตราย</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">บันทึกรายงาน</button>
        </form>
    </div>
@endsection
