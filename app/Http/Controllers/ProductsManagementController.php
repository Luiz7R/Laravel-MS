<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsManagementController extends Controller
{
     public $repository;
     public $repositoryCat;

     public function __construct(ProductsManagementRepository $repository,CategoriesRepository $repositoryCat)
     {
          $this->repository = $repository;          
          $this->repositoryCat = $repositoryCat;
     }

     public function manageProducts()
     {
            if ( ! Auth::check() )
                 return redirect()->route('msPageLogin');  

            $categories = $this->repositoryCat->getCategories();
            $products = $this->repository->getProducts();
            $productsWithoutPromo = $this->repository->getProductsWithoutPromo();
            $productsPromo = $this->repository->getPromoProducts();

            return view('manageProducts', compact('categories', 'products', 'productsWithoutPromo', 'productsPromo'));
     }
     public function postProduct(Request $request)
     {
          if ( empty(Auth::user()->id) )
              return abort(404);  

          $this->repository->postProduct($request);

          return redirect()->route('productsPage');
     }

     public function postPromoProduct(Request $request)
     {
          if ( empty(Auth::user()->id) )
              return abort(404);  

          $this->repository->postPromoProduct($request);

          return redirect()->route('getProducts');
     }

     public function getProduct($productId)
     {
          if ( empty(Auth::user()->id) )
               return abort(404); 

          return $this->repository->getProduct($productId);
     }

     public function getPromoProducts()
     {
          if ( empty(Auth::user()->id) )
               return abort(404); 

          return $this->repository->getPromoProducts(); 
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
