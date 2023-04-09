<?php

use App\Http\Controllers\videoMentorContrroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/mentor',[\App\Http\Controllers\mentorController::class,'index']);

