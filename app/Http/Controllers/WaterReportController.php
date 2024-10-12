<?php

namespace App\Http\Controllers;

use App\Models\WaterReport;
use Illuminate\Http\Request;

class WaterReportController extends Controller
{

    public function fetchWaterLevels()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.example.com/water-levels');
        $data = json_decode($response->getBody(), true);

        // Process and save the data
        foreach ($data as $item) {
            WaterReport::create([
                'location' => $item['location'],
                'water_source_type' => $item['type'],
                'water_source_name' => $item['name'],
                'water_level' => $item['level'],
                'status' => $this->determineStatus($item['level']),
            ]);
        }

        return redirect()->route('water-reports.index')->with('success', 'Water levels updated successfully');
    }

    private function determineStatus($level)
    {
        if ($level < 3)
            return 'normal';
        if ($level < 5)
            return 'warning';
        return 'danger';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waterReports = WaterReport::latest()->get();
        return view('water_reports.index', compact('waterReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('water_reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'location' => 'required|string|max:255',
            'water_source_type' => 'required|in:river,flood_area',
            'water_source_name' => 'required|string|max:255',
            'water_level' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:normal,warning,danger',
        ]);

        // Create a new WaterReport instance
        $waterReport = WaterReport::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('water-reports.index')
            ->with('success', 'รายงานระดับน้ำถูกบันทึกเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
