<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerBuyerController extends ApiController
{

    public function index($id)
    {
        $seller= Seller::has('products')->findOrFail($id);
        $buyers = $seller->products()->with('transactions.buyer')->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id')->values();
        return $this->showAll($buyers,200);
    }


}
