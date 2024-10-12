<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Request as HelpRequest; // เพิ่มเข้ามา
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    // เมธอดแสดงฟอร์มสำหรับสร้างรายงานใหม่
    public function index()
    {
        return view('report.index');
    }

    // เมธอดสำหรับบันทึกรายงาน
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:pending,reviewed,closed',
        ]);

        // สร้างรายงานใหม่
        Report::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'location' => $validatedData['location'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('report.index')->with('success', 'รายงานถูกสร้างสำเร็จ');
    }

    // เมธอดแสดงฟอร์มสำหรับสร้างคำขอความช่วยเหลือ
    public function helpRequestIndex()
    {
        return view('request.index');
    }

    public function storeHelpRequest(Request $request)
    {
        // ตรวจสอบและ validate ข้อมูลที่ส่งมา
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string', // เพิ่มการ validate สำหรับที่อยู่
            'phone_number' => 'required|string|max:15',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // สร้างคำขอความช่วยเหลือใหม่ในฐานข้อมูล
        try {
            HelpRequest::create([
                'user_id' => auth()->id(), // สมมติว่าผู้ใช้ล็อกอิน
                'name' => $validatedData['name'],
                'address' => $validatedData['address'], // ใช้ค่าที่ได้จากฟอร์ม
                'phone_number' => $validatedData['phone_number'],
                'description' => $validatedData['description'] ?? '',
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
            ]);

            return redirect()->route('request.index')->with('success', 'คำขอความช่วยเหลือถูกส่งเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }



}
