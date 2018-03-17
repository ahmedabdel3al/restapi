<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductBuyerController extends ApiController
{

    public function index(Product $product)
    {
        $buyers =$product->with('transactions.buyer')->get()->pluck('transactions')->collapse()->pluck('buyer')
        ->unique('id')->values();
       //    $product->transactions()->with('buyer')->get()->pluck('buyer')->unique('id')->values();
        return $this->showAll($buyers,200);
    }

}
