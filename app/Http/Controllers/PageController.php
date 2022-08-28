<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public $productRepository;
    public $categoryRepository;

    public function __construct(ProductsRepository $repository, CategoriesRepository $repositoryCat)
    {
         $this->productRepository = $repository;          
         $this->categoryRepository = $repositoryCat;
    }

    public function Homepage()
    {
        if ( ! Auth::check() )
            return view('/login');

          $products = $this->productRepository->getProducts();
          $latestProducts = $this->productRepository->latest();
          $categories = $this->categoryRepository->getCategories();
          $sales = Sales::all();

        return view('home', compact('categories', 'products', 'latestProducts', 'sales'));
    }

    public function Login()
    {
        if ( Auth::check() )
             return redirect('/');     
        
        return view('Login');
    }

    public function Register()
    {
         if ( Auth::check() )
              return redirect('/');

         return view('Register');
    }

    public function Statistics()
    {
         if ( ! Auth::check() )
              return redirect('/');
         
         return view('statistics');
    }

    public function getProductSales()
    {
          $products = $this->productRepository->getProductSales();

          return response()->json($products, 200, [], JSON_FORCE_OBJECT); 
    }

}
