<?php

use App\Http\Controllers\ComingSoonController;
use Illuminate\Support\Facades\Route;

Route::get('/', ComingSoonController::class)->name('home');
