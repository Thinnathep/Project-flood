@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-4 sm:p-6 lg:p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">ขอความช่วยเหลือ</h1>

        @if (session('success'))
            <div class="bg-green-200 p-4 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('request.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <!-- ชื่อ -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required>
            </div>

            <!-- ที่อยู่ -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">ที่อยู่</label>
                <input type="text" name="address" id="address"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required>
            </div>

            <!-- แผนที่ (Google Map) -->
            <div class="mb-4">
                <div id="map" class="w-full h-64 rounded-md shadow-sm"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
            </div>

            <!-- เบอร์โทร -->
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
                <input type="text" name="phone_number" id="phone_number"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required>
            </div>

            <!-- รายละเอียด -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">รายละเอียด</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
            </div>

            <!-- ปุ่มกดเพื่อใช้ตำแหน่งล่าสุด และ ปุ่มส่ง -->
            <div class="flex flex-col sm:flex-row mb-4 gap-2">
                <button type="button" onclick="getCurrentLocation()"
                    class="w-full sm:w-1/2 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">ใช้ตำแหน่งปัจจุบัน</button>

                <button type="submit"
                    class="w-full sm:w-1/2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">ส่งคำขอ</button>
            </div>
        </form>
    </div>


    <script>
        let map;
        let marker;

        function initMap() {
            const initialLocation = {
                lat: 13.7563, // ค่าพิกัดเริ่มต้น (กรุงเทพฯ)
                lng: 100.5018
            };

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: initialLocation,
            });

            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true,
            });

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });

            // ฟังก์ชันให้ผู้ใช้สามารถคลิกบนแผนที่เพื่อปักหมุด
            map.addListener('click', function(event) {
                placeMarker(event.latLng);
            });
        }

        function placeMarker(location) {
            // ลบ marker เดิม
            if (marker) {
                marker.setMap(null);
            }

            // สร้าง marker ใหม่ที่ตำแหน่งที่คลิก
            marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true,
            });

            // อัปเดตค่า latitude และ longitude
            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();

            // ฟังก์ชันที่ทำงานเมื่อผู้ใช้ลาก marker
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    marker.setPosition(new google.maps.LatLng(lat, lng));
                    map.setCenter(marker.getPosition());
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                }, function() {
                    alert("ไม่สามารถเข้าถึงตำแหน่งของคุณ");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>

    <!-- Google Maps Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChLse5DXerK5iubCdrSfI5p-K4AF0yhIU&callback=initMap" async
        defer></script>
@endsection
