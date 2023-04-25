<?php

namespace App\Domain\Child\Resources;

use App\Support\Traits\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class BraceletMeasurementResource extends JsonResource
{
    use WithPagination;
    public function toArray($request)
    {
        return [
            'id'                =>  $this->id,
            'heart_beats_rate'  =>  $this->heart_beats_rate,
            'temperature_rate'  =>  $this->temperature_rate,
            'latitude'          =>  $this->latitude,
            'longitude'         =>  $this->longitude,
            'since'             =>  $this->created_at->format('Y-m-d')
        ];
    }
}
