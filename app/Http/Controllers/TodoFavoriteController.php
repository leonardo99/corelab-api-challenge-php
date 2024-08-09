<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoFavoriteController extends Controller
{
    public function update($todo, FavoriteRequest $request)
    {
        try {
            $todoItem = Todo::findOrFail($todo);
            $todoItem->update(['is_favorite' => $request->is_favorite]);
            return new TodoResource($todoItem);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }
}
