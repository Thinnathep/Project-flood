@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>เพิ่มสถานที่ปลอดภัย</h1>

        <form action="{{ route('safe-places.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">ที่อยู่</label>
                <input type="text" name="address" class="form-control" id="address" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">เมือง</label>
                <input type="text" name="city" class="form-control" id="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">รัฐ</label>
                <input type="text" name="state" class="form-control" id="state" required>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control" id="latitude" required>
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control" id="longitude" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">รายละเอียด</label>
                <textarea name="description" class="form-control" id="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
@endsection
