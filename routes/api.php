<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\DoctorController;

Route::apiResource('specialists', SpecialistController::class);
Route::apiResource('doctors', DoctorController::class);