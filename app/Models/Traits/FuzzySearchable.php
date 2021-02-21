<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FuzzySearchable
{
    /**
     * @param Builder $query
     * @param string $column
     * @param string|null $keyword
     * @return Builder
     */
    public function scopeFuzzySearchable(Builder $query,string $column,?string $keyword)
    {
        if (filled($keyword)) {
            $query->where($column, 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}

