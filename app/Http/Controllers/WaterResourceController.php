<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WaterResourceController extends Controller
{
    public function fetchWaterResources()
    {
        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://srm-woc.dwr.go.th/waterresourcesinfo.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
            ],
        ]);

        // Execute cURL and close the session
        $response = curl_exec($curl);
        curl_close($curl);

        // แทนที่จะส่งคืน response ให้ส่งคืน array แทน
        if ($response === false) {
            Log::error('No response from the server');
            return [];
        }

        // Remove BOM if present
        $response = preg_replace('/^\xEF\xBB\xBF/', '', $response);

        // Log the raw response
        Log::info($response);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check for JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Unable to decode JSON: ' . json_last_error_msg());
            return [];
        }

        // Prepare an array to hold the filtered data
        // Prepare an array to hold the filtered data
        $filteredData = [];

        // Loop through the data to filter only the required fields
        foreach ($data as $item) {
            $filteredData[] = [
                'agencyCode' => $item['agencyCode'] ?? null,
                'waterResourcesName' => $item['waterResourcesName'] ?? null,
                'waterResourcesSize' => $item['waterResourcesSize'] ?? null,
                'capacity' => $item['capacity'] ?? null,
                'maximumLevel' => $item['maximumLevel'] ?? null,
                'locationCode' => $item['locationCode'] ?? null,
                'provinceCode' => $item['provinceCode'] ?? null,
                'amphoeCode' => $item['amphoeCode'] ?? null,
                'tambonCode' => $item['tambonCode'] ?? null,
                'basinCode' => $item['basinCode'] ?? null,
                'subBasinCode' => $item['subBasinCode'] ?? null,
                'latitude' => $item['latitude'] ?? null,
                'longitude' => $item['longitude'] ?? null,
                'elevationAreaCapacity' => $item['elevationAreaCapacity'] ?? null,
                'lastUpdateTime' => $item['lastUpdateTime'] ?? null,
            ];
        }

        // Sort the filtered data by 'lastUpdateTime' in descending order
        usort($filteredData, function ($a, $b) {
            $timeA = isset($a['lastUpdateTime']) ? strtotime($a['lastUpdateTime']) : 0;
            $timeB = isset($b['lastUpdateTime']) ? strtotime($b['lastUpdateTime']) : 0;

            return $timeB <=> $timeA; // Sort in descending order
        });

        // Return the filtered data as an array
        return $filteredData;
    }


    public function index()
    {

        $waterData = $this->fetchWaterResources();
        return view('water_resources.index', compact('waterData'));
    }





}
