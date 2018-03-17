<?php

namespace App\Http\Controllers\Seller;

use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerProductController extends ApiController
{
    public function index($id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        $products = $seller->products;
        return $this->showAll($products, 200);
    }


    public function store(Request $request, $id)
    {
        $rule = ['name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
        ];
        $this->validate($request, $rule);
        $data = $request->all();
        $data['seller_id'] = $id;
        $data['image'] = '1.jpg';
        $data['status'] = Product::UNAVILABLE;
        $product = Product::create($data);
        return $this->showOne($product, 200);
    }


    public function update(Request $request, $id, Product $product)
    {
        $rule = ['image' => 'required',
            'status' => 'in:' . Product::UNAVILABLE . ',' . Product::AVILABLE,
            'quantity' => 'integer|min:1',
        ];
        $this->validate($request, $rule);
        $data = $request->all();

        if ($id == $product->seller_id) {
            if($product->categories()->count()==0 && $product->isAvilable()){
                return $this->errorMassage('you can not update product with out adding first one category to this product',409);
            }
            $product->update($data);
            if(!$product->isDirty()){
                $product->save();
                return $this->showOne($product,201);
            }
           return $this->errorMassage('you need to change values to update',409);


        }
        return $this->errorMassage('you need to be owner of this product to update sorrry you can not do this update ',409);












    }


    public function destroy($id, Product $product)
    {
        if ($id == $product->seller_id) {
            $product->delete();
            return $this->showOne($product, 200);
        }
        return $this->errorMassage('you are not owner of this products to delete', 409);

    }
}
