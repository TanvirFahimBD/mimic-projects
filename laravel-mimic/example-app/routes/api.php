<?php

use App\Http\Controllers\DemoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'welcome from api';
});

Route::post('/getParameterByUrl2', [DemoController::class, 'GetParameterByUrl2']);
Route::post('/cookieRequest', [DemoController::class, 'CookieRequest']);
