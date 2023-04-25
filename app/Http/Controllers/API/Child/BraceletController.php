<?php

namespace App\Http\Controllers\API\Child;

use App\Domain\Child\Models\Bracelet;
use App\Domain\Child\Resources\BraceletMeasurementResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Child\BraceletMeasurementFilterRequest;
use App\Support\Services\APIResponse\ApiResponse;

class BraceletController extends Controller
{
    public function filter(BraceletMeasurementFilterRequest $request, Bracelet $bracelet)
    {
        $validated = $request->validated();
        $measurments = $bracelet->measurements()->whereBetween('created_at', [$validated['from'], $validated['to']])->get();
        return ApiResponse::success(BraceletMeasurementResource::collection($measurments));
    }

    public function syncBraceletMeasurement(Bracelet $bracelet)
    {
        $measurment = $bracelet->measurements()->latest()->limit(1)->first();
        return ApiResponse::success(new BraceletMeasurementResource($measurment));
    }
}
