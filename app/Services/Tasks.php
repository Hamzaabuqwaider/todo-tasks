<?php

namespace App\Services;

use App\Services\Dates;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Tasks
{


    public static function filter(QueryBuilder|Builder $query, array $options = []): QueryBuilder|Builder
    {
        $options = collect($options);

        if ($id = $options->get('id')) {
            $query->where('tasks.id', $id);
        }

        if ($status = $options->get('status')) {
            $query->where('tasks.status', $status);
        }

        if ($emailFilter = $options->get('emailFilter')) {
            $query->whereHas('user', function ($query) use ($emailFilter) {
                $query->where('users.email', 'like', '%' . $emailFilter . '%');
            });
        }

        Dates::filter($query, [
            'date_from' => $options->get('date_from'),
            'date_to' => $options->get('date_to'),
            'column' => $options->get('date_column', 'tasks.created_at'),
        ]);

        return $query;
    }

}
