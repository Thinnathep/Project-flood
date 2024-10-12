<?php

namespace App\Http\Controllers;

use App\Models\News; // Assuming you have a News model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลข่าวสารล่าสุด
        $news = News::latest()->take(5)->get(); // ดึง 5 ข่าวล่าสุด
        return view('home', compact('news'));
    }
}
