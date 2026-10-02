<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['name', 'model', 'year', 'color'];

    public function scopeByColor(Builder $query, ?string $color)
    {
        if ($color) {
            return $query->where('color', $color);
        }
        return $query;

    }

    public function scopeByYear(Builder $query, ?string $year)
    {
        if ($year) {
            return $query->where('year', $year);
        }
        return $query;
    }

    public function scopeOrder(Builder $query, ?string $column, ?string $direction)
    {
        if ($column && $direction) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }

    public function scopeSearch(Builder $query, ?string $value)
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
