<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // เพิ่มการใช้งาน Hash

class UserController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมด
        return view('admin.dashboard', compact('users')); // ส่งข้อมูลผู้ใช้ไปยัง view
    }

    // public function index()
    // {
    //     $users = User::all();
    //     return view('admin.users.index', compact('users')); // เปลี่ยนไปยังไฟล์ index ที่เหมาะสม
    // }

    public function create()
    {
        return view('admin.users.create'); // สร้าง view สำหรับสร้างผู้ใช้
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user')); // ส่งข้อมูลผู้ใช้ไปยัง view สำหรับการแก้ไข
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string', // ตรวจสอบว่ามี role
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // เข้ารหัสรหัสผ่าน
            'role' => $request->role, // บันทึก role
        ]);

        // ส่ง JSON response กลับไป
        return response()->json(['success' => true, 'message' => 'User added successfully.']);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // ไม่ให้ email ซ้ำกับผู้ใช้คนอื่น
            'role' => 'required|string|in:user,admin,superadmin', // ตรวจสอบว่า role ต้องเป็น admin หรือ user
        ]);

        // อัปเดตข้อมูลผู้ใช้
        $data = $request->only('name', 'email', 'role'); // เก็บข้อมูลที่ต้องการอัปเดต

        // ถ้ามีการส่งรหัสผ่านใหม่ให้เข้ารหัสและเพิ่มไปที่ $data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data); // อัปเดตข้อมูลผู้ใช้

        // ส่ง JSON response กลับไป
        return response()->json(['success' => true, 'message' => 'User updated successfully.']);
    }



    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }

}
