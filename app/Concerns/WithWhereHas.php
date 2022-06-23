<?php

namespace App\Concerns;

trait WithWhereHas
{
    public function scopeWithWhereHas($query, $relationship, $conditions)
    {
        $query->with($relationship, $conditions)
            ->whereHas($relationship, $conditions);
    }
}
