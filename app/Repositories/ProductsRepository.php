<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductsRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function postProduct(Request $request)
    {
        if ( empty(Auth::user()->id) )
             return abort(404); 

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);  

        return true;
    }

    public function getProduct($productId)
    {
        if ( empty(Auth::user()->id) )
             return abort(404); 

        return Product::find($productId);
    }

    public function getProducts()
    {
        if ( empty(Auth::user()->id) )
             return abort(404); 
        
        return Product::all();        
    }

    public function latest()
    {
        return Product::latest()->take(5)->get();
    }

    public function updateProduct(Request $request, $productId)
    {
        if ( empty(Auth::user()->id) )
             return abort(404); 

        $product = Product::where('user_id', Auth::user()->id)->findOrfail($productId);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();        
    }

    public function deleteProduct($productId)
    {

        if ( empty(Auth::user()->id) )
             return abort(404); 
        
        $product = Product::where('user_id', Auth::user()->id)->findOrfail($productId);

        $product->delete();        
    }

}