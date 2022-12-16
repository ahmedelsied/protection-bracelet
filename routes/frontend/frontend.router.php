<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    Log::info('request here !');
    return '<h1>Hello world</h1>';
});
