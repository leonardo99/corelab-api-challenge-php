<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        try {
            return TodoResource::collection(Todo::paginate());
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }

    public function store(TodoRequest $request)
    {
        try {
            $todo = Todo::create($request->validated());
            return new TodoResource($todo);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }

    public function show($todo) 
    {
        try {
            return new TodoResource(Todo::findOrFail($todo));
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }

    public function update($todo, TodoRequest $request) 
    {
        try {
            $todoItem = Todo::findOrFail($todo);
            $todoItem->update($request->validated());
            return new TodoResource($todoItem);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }

    public function destroy($todo)
    {
        try {
            $todoItem = Todo::findOrFail($todo);
            $todoItem->delete();
            return response()->json(['message' => 'O todo foi deletado.'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }
}
