<?php

namespace App\Http\Controllers;

use App\Actions\FilterTodos;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class SearchTodoController extends Controller
{
    public function index(Request $request)
    {
        try {

            $todos = FilterTodos::run($request->favorite)
            ->where('title', 'like', "%$request->search%")
            ->paginate();
            return TodoResource::collection($todos);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }
}
