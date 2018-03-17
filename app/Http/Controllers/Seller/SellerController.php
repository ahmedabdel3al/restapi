<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerController extends ApiController
{

    public function index()
    {
        $selers = Seller::has('products')->get();
        return $this->showAll($selers,200);
    }

    public function show($id)
    {
        $seler = Seller::has('products')->findOrFail($id);
        return $this->showOne($seler,200);


    }



}
