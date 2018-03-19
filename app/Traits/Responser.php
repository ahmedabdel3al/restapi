<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

Trait  Responser
{


    protected function showAll(Collection $collection, $code)
    {
        $collection = $this->sortData($collection);
        $collection = $this->paginate($collection);
        $collection = $this->cacheResponse($collection);

        return response()->json(['data' => $collection], $code);
    }

    protected function showOne(model $model, $code)
    {

        return response()->json(['data' => $model], $code);
    }

    protected function errorMassage($massage, $code)
    {
        return response()->json(['error' => $massage, 'code' => $code]);
    }

    protected function showMassage($massage, $code = 200)
    {
        return response()->json(['data' => $massage, 'code' => $code]);
    }

    protected function sortData(Collection $collection)
    {
        if (request()->has('sort_by')) {
            $attrabite = request()->sort_by;
            $collection = $collection->sortBy($attrabite);
        }
        return $collection;
    }

    protected function paginate($collection)
    {
        $page = lengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $result = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new lengthAwarePaginator($result, $collection->count(), $perPage, $page, ['path' => lengthAwarePaginator::resolveCurrentPath()]);
        return $paginated;
    }
    protected  function  cacheResponse($data){
        $url = request()->url();
        $queryPrameter = request()->query();
        ksort($queryPrameter);
        $queryString =http_build_query($queryPrameter);
        $fullUrl ="{$url}?{$queryString}";

        return Cache::remember($fullUrl, 30/60, function ()use($data){
           return $data;
        });

    }

}