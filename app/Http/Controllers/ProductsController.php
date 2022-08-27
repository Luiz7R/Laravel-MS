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
                return redirect()->route('msPageLogin');  

            $categories = $this->getCategories();
            $products = $this->getProducts();

            return view('products', compact('categories', 'products'));
     }

     public function postProduct(Request $request)
     {
          $this->repository->postProduct($request);

          return redirect()->route('productsPage');
     }

     public function getProducts()
     {
          $products = $this->repository->getProducts();

          return $products;
     }

     public function getCategories()
     {
          $categories = $this->repositoryCat->getCategories();

          return $categories;
     }     

     public function getProduct($productId)
     {
          if ( empty(Auth::user()->id) )
               return abort(404); 

          $product = $this->repository->getProduct($productId);

          return $product;
     }

     public function updateProduct(Request $request, $productId)
     {
          $this->repository->updateProduct($request, $productId);

          return true;
     }

     public function deleteProduct($productId)
     {
          $this->repository->deleteProduct($productId);
  
          return redirect()->route('msHome');
     }
}
