<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'child', 'as' => 'child.', 'namespace' => 'Child'], function () {
    Route::resource('bracelets', 'BraceletController');
});
