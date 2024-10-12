@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Water Resources</h1>

        @if (isset($waterData) && count($waterData) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 border-b text-left">Agency Code</th>
                            <th class="py-3 px-4 border-b text-left">Water Resource Name</th>
                            <th class="py-3 px-4 border-b text-left">Size</th>
                            <th class="py-3 px-4 border-b text-right">Capacity (m³)</th>
                            <th class="py-3 px-4 border-b text-right">Maximum Level (m)</th>
                            <th class="py-3 px-4 border-b text-center">Last Update</th>
                            <th class="py-3 px-4 border-b text-center">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($waterData as $item)
                            <tr class="bg-white hover:bg-gray-100 transition duration-150 even:bg-gray-50">
                                <td class="py-2 px-4 border-b text-left">{{ $item['agencyCode'] }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item['waterResourcesName'] }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item['waterResourcesSize'] }}</td>
                                <td class="py-2 px-4 border-b text-right">{{ $item['capacity'] }}</td>
                                <td class="py-2 px-4 border-b text-right">{{ $item['maximumLevel'] }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    {{ \Carbon\Carbon::parse($item['lastUpdateTime'])->format('d-m-Y H:i:s') }}
                                    <!-- ปรับรูปแบบวันที่ที่นี่ -->
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $item['latitude'] }},{{ $item['longitude'] }}"
                                        class="text-blue-500 underline" target="_blank">Show on Map</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Google Maps -->
            <div id="map" class="mt-6 h-96 w-full"></div>
        @else
            <div class="mt-4">
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Notice!</strong>
                    <span class="block sm:inline">No water resource data available.</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Google Maps API Script -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChLse5DXerK5iubCdrSfI5p&callback=initMap">
    </script>

@endsection
