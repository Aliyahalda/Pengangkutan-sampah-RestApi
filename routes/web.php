<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampahController;

Route::get('/', [SampahController::class, 'token']);

