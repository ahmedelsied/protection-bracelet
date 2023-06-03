<?php

namespace App\Domain\Child\Resources;

use App\Support\Traits\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class BraceletMeasurementResource extends JsonResource
{
    use WithPagination;

    public function __construct($resource,private $collection = true)
    {
        parent::__construct($resource);
    }
    public function toArray($request)
    {

        return [
            'since'             =>  $this->collection ? $this->first()?->day : $this->created_at?->format('Y-m-d'),
            'times'             =>  $this->times()
        ];
    }

    private function times()
    {
        if($this->collection){
            $times = $this->map(function($measurement){
                return [
                    'id'                =>  $measurement->id,
                    'heart_beats_rate'  =>  $measurement->heart_beats_rate,
                    'temperature_rate'  =>  $measurement->temperature_rate,
                    'latitude'          =>  $measurement->latitude,
                    'longitude'         =>  $measurement->longitude,
                    'time'              =>  $measurement->created_at?->format('h:i'),
                ];
            });
        }else{
            $times = [
                'id'                =>  $this->id,
                'heart_beats_rate'  =>  $this->heart_beats_rate,
                'temperature_rate'  =>  $this->temperature_rate,
                'latitude'          =>  $this->latitude,
                'longitude'         =>  $this->longitude,
                'time'              =>  $this?->created_at->format('h:i'),
            ];
        }
        return $times;
    }
}
