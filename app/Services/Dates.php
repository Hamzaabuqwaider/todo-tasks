<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Dates
{
    const COLUMN = 'column';
    const DATE_FROM = 'date_from';
    const DATE_TO = 'date_to';
    const EXACT_DATE = 'exact_date';
    const TIME_FROM = 'time_from';
    const TIME_TO = 'time_to';
    const MONTH_FROM = 'month_from';
    const MONTH_TO = 'month_to';

    public static function filter(QueryBuilder|Builder &$query, array $options = [])
    {
        $column = !empty($options[self::COLUMN]) ? $options[self::COLUMN] : 'created_at';
        $auth_timezone = $options['auth_timezone'] ?? true;

        if ($exact_date = $options[self::EXACT_DATE] ?? false) {
            $exact_date = Carbon::parse($exact_date)->format('Y-m-d');
            $query = $query->whereRaw(Queries::date_format($column, auth_timezone: $auth_timezone) . " = ?", [$exact_date]);
        }

        if ($date_from = $options[self::DATE_FROM] ?? false) {
            $date_from = Carbon::parse($date_from)->startOfDay();
            $query = $query->whereRaw(Queries::convert_tz($column, auth_timezone: $auth_timezone) . " >= ?", [$date_from]);
        }

        if ($date_to = $options[self::DATE_TO] ?? false) {
            $date_to = Carbon::parse($date_to)->endOfDay();
            $query = $query->whereRaw(Queries::convert_tz($column, auth_timezone: $auth_timezone) . " <= ?", [$date_to]);
        }

        if ($time_from = $options[self::TIME_FROM] ?? false) {
            $query = $query->whereRaw("$column >= ?", [$time_from]);
        }

        if ($time_to = $options[self::TIME_TO] ?? false) {
            $query = $query->whereRaw("$column <= ?", [$time_to]);
        }

        if ($month_from = $options[self::MONTH_FROM] ?? false) {
            $month_from = Carbon::make($month_from)->endOfMonth()->format('Y-m-d');
            $query = $query->whereRaw(Queries::last_day($column, auth_timezone: $auth_timezone) . " >= ?", [$month_from]);
        }

        if ($month_to = $options[self::MONTH_TO] ?? false) {
            $month_to = Carbon::make($month_to)->endOfMonth()->format('Y-m-d');
            $query = $query->whereRaw(Queries::last_day($column, auth_timezone: $auth_timezone) . " <= ?", [$month_to]);
        }

        return $query;
    }

}
