<?php

namespace App\Domain\Child\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BraceletResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    =>  $this->id,
            'child_name'    =>  $this->child_name,
            'code'    =>  $this->code,
            // 'meseu'     =>  
        ];
    }
}
