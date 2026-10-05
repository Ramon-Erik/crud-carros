<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'model', 'year', 'color'];

    #[Scope]
    public function filterByColor(Builder $query, ?string $color)
    {
        if ($color) {
            return $query->where('color', $color);
        }
        return $query;

    }

    #[Scope]
    public function filterByYear(Builder $query, ?string $year)
    {
        if ($year) {
            return $query->where('year', $year);
        }
        return $query;
    }

    #[Scope]
    public function order(Builder $query, ?string $column, ?string $direction)
    {
        if ($column && $direction) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }

    #[Scope]
    public function search(Builder $query, ?string $value)
    {
        if ($value) {
            return $query->whereAny(
                ['name', 'model'],
                'like',
                "%$value%");
        }
        return $query;
    }
}
