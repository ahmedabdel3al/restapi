<?php

namespace App\Http\Controllers\seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        $transaction = $seller->products()->with('transactions')->get()->pluck("transactions")->collapse();
        return $this->showAll($transaction, 200);
    }

}
