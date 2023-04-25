<?php

namespace App\Http\Controllers\API;

use App\Domain\Child\Models\BraceletMeasurement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ESPController extends Controller
{
    private $rules = [
        'object_temperature'    =>  'nullable|sometimes|numeric',
        'heart_beat'            =>  'nullable|sometimes|numeric',
        'lat'                   =>  'nullable|sometimes|numeric',
        'lng'                   =>  'nullable|sometimes|numeric'
    ];
    public function index(Request $request)
    {
        $validated = $request->validate($this->rules);

       BraceletMeasurement::create([
            'bracelet_id'       =>  1,
            'heart_beats_rate'  =>  $validated['heart_beat'],
            'temperature_rate'  =>  $validated['object_temperature'],
            'latitude'          =>  $validated['lat'],
            'longitude'         =>  $validated['lng']
       ]);

       return response()->json(['success' => true]);
    }
}
