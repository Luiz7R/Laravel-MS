<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductsManagementController extends Controller
{
     public $repository;

     public function __construct(ProductRepository $repository)
     {
          $this->repository = $repository;
     }

     public function ProductsPage()
     {
            if ( ! Auth::check() )
            {
                 return redirect()->route('msPageLogin');  
            }

            $categories = $this->getCategories();
            $products = $this->getProducts();
            $productsPromo = $this->getPromoProducts();

            return view('products', compact('categories', 'products'));
     }

     public function getProducts()
     {
          if ( empty(Auth::user()->id) )
              return abort(404); 

          return $this->repository->getProducts();
     }    

     public function getProduct($productId)
     {
          if ( empty(Auth::user()->id) )
          {
               return abort(404); 
          }

          return $this->repository->getProduct($productId);
     } 
}
