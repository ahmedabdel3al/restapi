<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Seller;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
{
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();


        return response()->json(['data'=>$buyers],200);
    }



    public function show($id)
    {
        $buyer = Buyer::has('transactions')->findOrFail($id);
        return response()->json(['data'=>$buyer],200);
    }


}
