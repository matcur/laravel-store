<?php


namespace App\Paginators;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CollectionPaginator
{
    public static function paginate(Collection $collection, $perPage = 10)
    {
        $total = $collection->count();

        $currentPage = Paginator::resolveCurrentPage('page');

        $pageItems = $collection->forPage($currentPage, $perPage);

        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ];

        return self::paginator($pageItems, $total, $perPage, $currentPage, $options);
    }

    private static function paginator($pageItems, $total, $perPage, $currentPage = null, array $options = [])
    {
        return new LengthAwarePaginator($pageItems, $total, $perPage, $currentPage, $options);
    }
}
