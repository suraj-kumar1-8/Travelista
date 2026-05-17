<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Show weather information.
     * This is a placeholder implementation returning static data.
     */
    public function show(Request $request)
    {
        // In a real implementation, integrate with a weather API using API key.
        return response()->json([
            'location' => 'Default City',
            'weather' => 'Sunny',
            'temperature' => 30,
            'unit' => 'Celsius',
        ]);
    }
}
