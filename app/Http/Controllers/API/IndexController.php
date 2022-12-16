<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function index()
    {
        Log::info('request here !');
        return response()->json([
            'message' => 'Hello world',
            'time'    => now()->format('Y-m-d h:ia')
        ]);
    }
}
