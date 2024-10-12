<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index()
    {
        return view('volunteer.index'); // แสดงฟอร์มใน index
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'skills' => 'required|string|max:255',
            'availability' => 'required|string|max:255',
        ]);

        Volunteer::create([
            'user_id' => Auth::id(), // เก็บ user_id ของผู้ใช้ที่ล็อกอินอยู่
            'skills' => $request->skills,
            'availability' => $request->availability,
        ]);

        return redirect()->route('volunteer.index')->with('success', 'ลงทะเบียนอาสาสมัครเรียบร้อยแล้ว!');
    }
}
