<?php

namespace App\Http\Controllers\API\Child;

use App\Domain\Child\Models\Bracelet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BraceletController extends Controller
{
    public function filter(Bracelet $bracelet)
    {
        return $bracelet->measurements()->whereBetween('created_at', [request('from'), request('to')])->get();
    }
}
