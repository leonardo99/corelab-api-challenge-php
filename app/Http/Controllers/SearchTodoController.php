<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class SearchTodoController extends Controller
{
    public function index(Request $request)
    {
        try {

            $todos = Todo::query()
            ->when($request->favorite === 'true', function($todos) {
                return $todos->where('is_favorite', 1);
            })
            ->when($request->favorite === 'false', function($todos) {
                return $todos->where('is_favorite', 0);
            })
            ->where('title', 'like', "%$request->search%")
            ->paginate();

            return TodoResource::collection($todos);
        } catch (\Exception $e) {
            return response()->json(['data' => ['error' => $e->getMessage()]], 500);
        }
    }
}
