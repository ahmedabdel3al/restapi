<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerCategoryController extends ApiController
{
    public function index($id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        $categories=$seller->products()->with('categories')->get()->pluck('categories')->collapse()->unique('id')->values();
        return $this->showAll($categories,200);
    }

}
