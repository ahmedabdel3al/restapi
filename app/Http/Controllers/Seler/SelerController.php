<?php

namespace App\Http\Controllers\Seler;

use App\Seler;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SelerController extends ApiController
{

    public function index()
    {
        $selers = Seler::has('products')->get();
        return response()->json(['data'=>$selers],200);
    }

    public function show($id)
    {
        $seler = Seler::has('products')->findOrFail($id);
        return response()->json(['data'=>$seler],200);


    }



}
