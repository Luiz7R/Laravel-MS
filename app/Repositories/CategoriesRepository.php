<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function getCategory($categoryId)
    {
        if ( empty(Auth::user()->id) )
        {
            return abort(404);
        }

        $category = Categorie::findOrFail($categoryId);

        return $category;
    }

    public function getCategories()
    {
        if ( empty(Auth::user()->id) )
        {
            return abort(404);
        }

        return Categorie::all();
    }

    public function postCategory( Request $request )
    {
        $categoryName = $request->category_name;

        Categorie::create([
          'category_name' => $categoryName,
          'user_id' => Auth::user()->id
        ]);

        return true;
    }

    public function updateCategory(Request $request, $categoryId)
    {
        if ( empty(Auth::user()->id) )
        {
            return abort(404); 
        }
 
        $category = Categorie::where('user_id', Auth::user()->id)->findOrfail($categoryId);
 
        $category->category_name = $request->category_name;
        $category->save();
    }

    public function deleteCategory($categoryId)
    {
        if ( empty(Auth::user()->id) )
        {
            return abort(404); 
        }
        
        $category = Categorie::where('user_id', Auth::user()->id)->findOrfail($categoryId);

        $category->delete();
    }
}