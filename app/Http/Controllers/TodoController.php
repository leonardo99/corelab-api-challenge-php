<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(Todo::paginate());
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::create($request->validated());
        return new TodoResource($todo);
    }

    public function show($todo) 
    {
        return new TodoResource(Todo::findOrFail($todo));
    }

    public function update($todo, TodoRequest $request) 
    {
        $todoItem = Todo::findOrFail($todo);
        $todoItem->update($request->validated());
        return new TodoResource($todoItem);
    }

    public function destroy($todo)
    {
        $todoItem = Todo::findOrFail($todo);
        $todoItem->delete();
        return response()->json(['message' => 'O todo foi deletado.'], 200);
    }
}
