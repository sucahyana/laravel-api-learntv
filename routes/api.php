<?php

use App\Http\Controllers\MentorController;
use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;

// Rute untuk Mentor
Route::post('/mentors', [MentorController::class, 'store']); // Endpoint POST /mentors untuk menambahkan mentor baru
Route::get('/mentors', [MentorController::class, 'index']); // Endpoint GET /mentors untuk mengambil daftar mentor
Route::get('/mentors/{id}', [MentorController::class, 'show']); // Endpoint GET /mentors/{id} untuk mengambil detail mentor berdasarkan ID
Route::put('/mentors/{id}', [MentorController::class, 'update']); // Endpoint PUT /mentors/{id} untuk mengupdate data mentor berdasarkan ID
Route::delete('/mentors/{id}', [MentorController::class, 'destroy']); // Endpoint DELETE /mentors/{id} untuk menghapus mentor berdasarkan ID

// Rute untuk Stream
Route::post('/streams', [StreamController::class, 'store']); // Endpoint POST /streams untuk menambahkan stream baru
Route::get('/streams', [StreamController::class, 'index']); // Endpoint GET /streams untuk mengambil daftar stream
Route::get('/streams/{code_id}', [StreamController::class, 'show'])->name('api.streams.show');
 // Endpoint GET /streams/{id} untuk mengambil detail stream berdasarkan CODE_ID
Route::put('/streams/{id}', [StreamController::class, 'update']); // Endpoint PUT /streams/{id} untuk mengupdate data stream berdasarkan ID
Route::delete('/streams/{id}', [StreamController::class, 'destroy']); // Endpoint DELETE /streams/{id} untuk menghapus stream berdasarkan ID
