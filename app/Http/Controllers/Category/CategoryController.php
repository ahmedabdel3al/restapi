<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryController extends ApiController
{

    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories, 200);
    }


    public function store(Request $request)
    {
        $rule = ['name' => 'required|min:3',
            'description' => 'required|min:5|max:100',
        ];
        $this->validate($request, $rule);
        $categories = Category::create($request->all());
        $categories->save();
        dd($categories);
        //return $this->showAll($categories, 200);
    }


    public function show(Category $category)
    {
        return $this->showOne($category, 200);
    }


    public function update(Request $request, Category $category)
    {
        $rule = ['name' => 'min:3',
            'description' => 'min:5|max:100',
        ];
        $this->validate($request, $rule);
        if ($request->has('name')) {
            $category->name = $request->get('name');
        }
        if ($request->has('description')) {
            $category->description = $request->get('description');

        }
        if (!$category->isDirty()) {
            return $this->errorMassage('you need to change your value to update ', 409);
        }
        $category->save();
        return response()->json($category, 200);

    }


    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category,200);
    }
}
