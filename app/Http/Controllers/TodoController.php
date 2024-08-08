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
}
