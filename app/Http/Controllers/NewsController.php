<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NewsController extends Controller
{

    // ฟังก์ชันสำหรับค้นหาข่าว
    public function search(Request $request)
    {
        $client = new Client();
        $query = $request->input('query', 'น้ำท่วม');

        $response = $client->request('GET', 'https://newsapi.org/v2/everything', [
            'query' => [
                'q' => $query,
                'apiKey' => 'b1fbd33e769f435c9ba7f7da2e3b4ceb',
                'language' => 'th',
                'pageSize' => 10,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return view('news.search', [
            'news' => $data['articles'] ?? []
        ]);
    }


    // ฟังก์ชันสำหรับแสดงรายการข่าวทั้งหมด
    public function index()
    {
        // ดึงข้อมูลข่าวทั้งหมดจากฐานข้อมูล
        $news = News::latest()->paginate(10); // แบ่งหน้า 10 รายการต่อหน้า

        // ส่งข้อมูลไปยัง view 'news.index'
        return view('news.index', compact('news'));
    }

    // ฟังก์ชันสำหรับแสดงรายละเอียดข่าวแต่ละรายการ
    public function show($id)
    {
        // ดึงข้อมูลข่าวตาม ID
        $newsItem = News::findOrFail($id);

        // ส่งข้อมูลไปยัง view 'news.show'
        return view('news.show', compact('newsItem'));
    }
}
