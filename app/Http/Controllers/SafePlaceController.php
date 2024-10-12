<?php

namespace App\Http\Controllers;

use App\Models\SafePlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SafePlaceController extends Controller
{
    public function index()
    {
        $safePlaces = SafePlace::all();
        return view('safe_place.index', compact('safePlaces'));
    }

    public function create()
    {
        return view('safe_place.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        SafePlace::create($request->all());

        return redirect()->route('safe-places.index')->with('success', 'Safe place created successfully.');
    }

    public function show($id)
    {
        $safePlace = SafePlace::findOrFail($id);
        return view('safe_place.show', compact('safePlace'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        // ใช้ Perplexity API เพื่อค้นหาสถานที่ปลอดภัย
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . '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',
        ])->get('https://api.perplexity.ai/v1/search', [
                    'query' => $query,
                ]);

        // แปลงข้อมูลจาก API เป็นอาร์เรย์
        $results = json_decode($response->getBody(), true);

        return view('safe_place.search_results', compact('results'));
    }




}
