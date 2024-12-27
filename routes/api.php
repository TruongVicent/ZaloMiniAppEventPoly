<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TickitController;
use App\Http\Controllers\SoftwareProjectController;
use App\Http\Controllers\EventController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tickits', [TickitController::class, 'store']);
Route::get('/software-projects',[SoftwareProjectController::class, 'index']);
Route::get('/events', [EventController::class, 'index']);


