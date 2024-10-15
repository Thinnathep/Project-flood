@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">แดชบอร์ด</h1>

        <!-- ข้อมูลสถิติหรือเนื้อหาที่คุณต้องการแสดงในแดชบอร์ด -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">สถิติ</h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <!-- ตัวอย่างข้อมูลสถิติ -->
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">จำนวนผู้ใช้ทั้งหมด</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">1,234</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">รายงานที่ส่งมา</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">567</dd>
                    </div>
                    <!-- เพิ่มข้อมูลสถิติอื่น ๆ ได้ตามต้องการ -->
                </dl>
            </div>
        </div>

        <!-- เนื้อหาเพิ่มเติมที่คุณต้องการแสดงในแดชบอร์ด -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">กิจกรรมล่าสุด</h3>
            </div>
            <div class="border-t border-gray-200">
                <ul class="divide-y divide-gray-200">
                    <!-- ตัวอย่างรายการกิจกรรมล่าสุด -->
                    <li class="py-4 flex items-center space-x-4 px-4 sm:px-6">
                        <span
                            class="flex-shrink-0 bg-blue-100 text-blue-800 rounded-full h-8 w-8 flex items-center justify-center">JD</span>
                        <span class="text-sm font-medium text-gray-900">ผู้ใช้ JohnDoe ส่งรายงาน</span>
                    </li>
                    <li class="py-4 flex items-center space-x-4 px-4 sm:px-6">
                        <span
                            class="flex-shrink-0 bg-green-100 text-green-800 rounded-full h-8 w-8 flex items-center justify-center">JD</span>
                        <span class="text-sm font-medium text-gray-900">ผู้ใช้ JaneDoe ลงทะเบียนเป็นอาสาสมัคร</span>
                    </li>
                    <!-- เพิ่มกิจกรรมอื่น ๆ ได้ตามต้องการ -->
                </ul>
            </div>
        </div>
    </div>
@endsection
