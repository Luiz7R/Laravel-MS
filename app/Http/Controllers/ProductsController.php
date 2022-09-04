<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductsController extends Controller
{
     public $repository;
     public $repositoryCat;

     public function __construct(ProductsRepository $repository,CategoriesRepository $repositoryCat)
     {
          $this->repository = $repository;          
          $this->repositoryCat = $repositoryCat;
     }

     public function ProductsPage()
     {
            if ( ! Auth::check() )
            {
                 return redirect()->route('msPageLogin');  
            }

            $categories = $this->getCategories();
            $products = $this->getProducts();

            return view('products', compact('categories', 'products'));
     }

     public function postProduct(Request $request)
     {
          if ( empty(Auth::user()->id) )
          {
              return abort(404);  
          }

          $this->repository->postProduct($request);

          return redirect()->route('productsPage');
     }

     public function getProducts()
     {
          if ( empty(Auth::user()->id) )
          {
              return abort(404); 
          }

          return $this->repository->getProducts();
     }

     public function getCategories()
     {
          return $this->repositoryCat->getCategories();
     }     

     public function getProduct($productId)
     {
          if ( empty(Auth::user()->id) )
          {
               return abort(404); 
          }

          return $this->repository->getProduct($productId);
     }

     public function updateProduct(Request $request, $productId)
     {
          $request->merge(['product_id' => $productId]);

          $this->validate($request, [
               'product_id' => 'required|exists:products,id'
          ]);

          return $this->repository->updateProduct($request, $productId);
     }

     public function deleteProduct(Request $request, $productId)
     {
          $request->merge(['product_id' => $productId]);

          $this->validate($request, [
               'product_id' => 'required|exists:products,id'
          ]);

          return $this->repository->deleteProduct($productId);
     }
}
