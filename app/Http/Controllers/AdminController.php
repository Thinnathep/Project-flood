<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // เพิ่มการ import โมเดล User
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // ตรวจสอบบทบาทผู้ใช้ที่เข้าถึง
        if (!Auth::check() || (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('superadmin'))) {
            return redirect('/'); // เปลี่ยนเส้นทางถ้าไม่มีสิทธิ์เข้าถึง
        }

        // ดำเนินการตามปกติ
        return view('admin.dashboard');
    }

}
