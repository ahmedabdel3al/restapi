<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    public function store(Request $request, Product $product, User $buyer)
    {
        $rule = ['quantity' => 'required|integer|min:1'];
        $this->validate($request, $rule);
        if ($buyer->id == $product->seller->id) {
            return $this->errorMassage('buyer and seller are one ', 409);
        }
        if (!$buyer->isVerified()) {
            return $this->errorMassage('buyer must be verified to complete this step ', 404);
        }
        if (!$product->seller->isVerified()) {
            return $this->errorMassage('seller must be verified to complete this step ', 404);
        }
        if (!$product->isAvilable()) {
            return $this->errorMassage('this product is not avilable  ', 404);
        }
        if ($product->quantity < $request->quantity) {
            return $this->errorMassage('this product quantity is less than your order', 404);
        }
        return DB::Transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();
            $transaction = Transaction::create([
                'product_id' => $product->id,
                'buyer_id' => $product->id,
                'quantity' => $request->quantity,

            ]);
            return $this->showOne($transaction, 201);

        });

    }
}
