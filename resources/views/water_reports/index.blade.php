@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">รายงานระดับน้ำทั้งหมด</h2>
        <a href="{{ route('water-reports.create') }}"
            class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mb-4">
            เพิ่มรายงานใหม่
        </a>
        <table class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border p-2">สถานที่</th>
                    <th class="border p-2">ประเภท</th>
                    <th class="border p-2">ชื่อแหล่งน้ำ</th>
                    <th class="border p-2">ระดับน้ำ</th>
                    <th class="border p-2">สถานะ</th>
                    <th class="border p-2">วันที่รายงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($waterReports as $report)
                    <tr>
                        <td class="border p-2">{{ $report->location }}</td>
                        <td class="border p-2">{{ $report->water_source_type == 'river' ? 'แม่น้ำ' : 'พื้นที่น้ำท่วม' }}
                        </td>
                        <td class="border p-2">{{ $report->water_source_name }}</td>
                        <td class="border p-2">{{ $report->water_level }} เมตร</td>
                        <td class="border p-2">
                            <span
                                class="px-2 py-1 rounded {{ $report->status == 'normal' ? 'bg-green-200' : ($report->status == 'warning' ? 'bg-yellow-200' : 'bg-red-200') }}">
                                {{ $report->status == 'normal' ? 'ปกติ' : ($report->status == 'warning' ? 'เฝ้าระวัง' : 'อันตราย') }}
                            </span>
                        </td>
                        <td class="border p-2">{{ $report->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
