<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductsManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
     public $repository;
     public $categoriesRepository;
     public $productsManagementRepository;

     public function __construct(ProductRepository $repository, CategoriesRepository $categoriesRepository, 
          ProductsManagementRepository $productsManagementRepository)
     {
          $this->repository = $repository;
          $this->productsManagementRepository = $productsManagementRepository;
          $this->categoriesRepository = $categoriesRepository;
     }

     public function ProductsPage(Request $request)
     {
            if ( ! Auth::check() )
            {
                 return redirect()->route('msPageLogin');  
            }

            if ( $request->msSearch ) {
               return redirect()->route('msSearch',['msSearch' => $request->msSearch]);
            }
            $categories = $this->categoriesRepository->getCategories();
            $products = $this->getProducts();
            $productsPromo = $this->productsManagementRepository->getPromoProducts();
            $mostSales = $this->productsManagementRepository->getProductSales();

            return view('products', compact('categories', 'products', 'productsPromo', 'mostSales'));
     }

     public function productsSearch($msSearch)
     {
            if ( ! Auth::check() )
            {
                 return redirect()->route('msPageLogin');  
            }
            $productsFind = $this->repository->productSearch($msSearch);
          return view('products.productsSearch', compact(['productsFind','msSearch']));
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
     
     public function releases() {
          $releases = $this->repository->latest();

          return view('products.releases', compact('releases'));
     }

     public function promotions() {
          $productsPromo = $this->productsManagementRepository->getPromoProducts();

          return view('products.promotions', compact('productsPromo'));
     }

     public function tennis() {
          $productsTennis = $this->productsManagementRepository->getTennisProducts();

          return view('products.tennis', compact('productsTennis'));
     }

     public function slippers() {
          $slippers = $this->productsManagementRepository->getSlipperProducts();

          return view('products.slippers', compact('slippers'));
     }
}
