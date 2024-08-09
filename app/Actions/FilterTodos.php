<?php

namespace App\Actions;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;

class FilterTodos
{
    private function execute(?string $favorite): Builder
    {
        return Todo::query()
        ->when($favorite === 'true', function($todos) {
            return $todos->where('is_favorite', 1);
        })
        ->when($favorite === 'false', function($todos) {
            return $todos->where('is_favorite', 0);
        });
    }
    
    public static function run(?string $favorite): Builder
    {
        return (new self())->execute($favorite);
    }
}