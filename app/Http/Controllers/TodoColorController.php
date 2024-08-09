<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoColorController extends Controller
{
    public function update($todo, Request $request)
    {
        try {
            $todoItem = Todo::findOrFail($todo);
            $todoItem->update(['color' => $request->color]);
            return new TodoResource($todoItem);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }
}
