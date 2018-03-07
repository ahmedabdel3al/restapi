<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

Trait  Responser
{


    protected function showAll(Collection $collection, $code)
    {

        return response()->json(['data' => $collection], $code);
    }

    protected function showOne(model $model, $code)
    {

        return response()->json(['data' => $model], $code);
    }

    protected function errorMassage($massage, $code)
    {
        return response()->json(['error' => $massage, 'code'=>$code]);
    }


}