<?php

use App\Http\Controllers\SearchTodoController;
use App\Http\Controllers\TodoColorController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoFavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('todo', TodoController::class);
Route::group(['prefix' => 'todo'], function(){
    Route::patch('{todo}/color', [TodoColorController::class, 'update']);
    Route::patch('{todo}/favorite', [TodoFavoriteController::class, 'update']);
});
Route::get('search', [SearchTodoController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
