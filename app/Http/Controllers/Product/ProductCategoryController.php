<?php

namespace App\Http\Controllers\Product;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{

    public function index(Product $product)
    {
        $categoires = $product->categories;
        return $this->showAll($categoires, 200);

    }

    public function update(Request $request, Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories, 200);
    }

    public function destroy(Product $product, Category $category)
    {
       if(!$product->categories()->find($category->id))
       {
          return $this->errorMassage('we can not find this category for this product ',404);
       }
        $product->categories()->detach([$category->id]);
        return $this->showAll($product->categories, 200);

    }
}
