<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendRequestController;

Route::post('/request', [SendRequestController::class, 'index']);
