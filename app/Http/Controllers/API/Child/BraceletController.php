<?php

namespace App\Http\Controllers\API\Child;

use App\Domain\Child\Models\Bracelet;
use App\Domain\Child\Resources\BraceletMeasurementResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Child\BraceletMeasurementFilterRequest;
use App\Support\Services\APIResponse\ApiResponse;
use Illuminate\Support\Carbon;

class BraceletController extends Controller
{
    public function filter(BraceletMeasurementFilterRequest $request, Bracelet $bracelet)
    {
        $validated = $request->validated();
        $measurments = $bracelet->measurements()->selectRaw('*,DATE(created_at) as day')->whereBetween('created_at', [$validated['from'], $validated['to']])->get()->groupBy('day');
        return ApiResponse::success(BraceletMeasurementResource::collection($measurments)->flatten());
    }

    public function syncBraceletMeasurement(Bracelet $bracelet)
    {
        $measurment = $bracelet->measurements()->selectRaw('*,DATE(created_at) as day')->latest()->limit(1)->first();
        if(is_null($measurment)){
            return ApiResponse::success([]);
        }
        return ApiResponse::success(new BraceletMeasurementResource($measurment,false));
    }
}
