<?php

use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
