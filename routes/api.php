<?php

use App\Http\Controllers\TodoColorController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('todo', TodoController::class);
Route::patch('todo/{todo}/color', [TodoColorController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
