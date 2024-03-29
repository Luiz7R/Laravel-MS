<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    public $model;
    public function __construct()
    {
        $this->model = new Product();
    }

    public function postProduct(Request $request)
    {
        return Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);  
    }

    public function getProduct($productId)
    {
        return $this->model->find($productId);
    }

    public function getProducts()
    {   
        return $this->model->all();        
    }

    public function latest()
    {
        return $this->model->latest()->take(5)->get();
    }

    public function updateProduct(Request $request, $productId)
    {
        if ( empty(Auth::user()->id) )
        {
            return abort(404); 
        }

        $product = $this->model->findOrFail($productId);

        $product->name = $request['name'];
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();        

        return $product;
    }

    public function deleteProduct($productId)
    {
        if ( empty(Auth::user()->id) )
        {
            return abort(404); 
        }
        
        return $this->model->where('user_id', Auth::user()->id)->find($productId)->delete(); 
    }

    public function getProductSales() : Collection
    {
        $products = $this->model->all();

        collect($products)->map(function($product) {
            $product['sales'] = $product->getProductSales();

            if ( $product['sales'] ) 
            {
                $product['total'] = floatval($product->price) * $product['sales'];
            }
        });

        return $products;
    }

    public function getTotalSales() : float
    {
        $products = $this->model->all();
        $total = 0;

        foreach($products as $product)
        {
            $product['sales'] = $product->getProductSales();

            if ( $product['sales'] )
            {
                $total += floatval($product->price) * $product['sales'];
            }  
        }

        return $total;
    }

    public function productSearch($payloadSearch) {
        return $this->model->where('name', 'like', '%'.$payloadSearch.'%')->get();
    }

}