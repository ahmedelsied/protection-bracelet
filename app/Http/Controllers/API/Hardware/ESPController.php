<?php

namespace App\Http\Controllers\API\Hardware;

use App\Domain\Child\Models\BraceletMeasurement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

        if(!empty($validated)){
            BraceletMeasurement::firstOrCreate([
                'bracelet_id'       =>  1,
                'heart_beats_rate'  =>  Arr::get($validated,'heart_beat'),
                'temperature_rate'  =>  Arr::get($validated,'object_temperature'),
                'latitude'          =>  Arr::get($validated,'lat'),
                'longitude'         =>  Arr::get($validated,'lng')
            ]);
        };

        return response()->json(['success' => true]);
    }
}
