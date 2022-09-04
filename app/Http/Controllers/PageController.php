<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyFormatHelper;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SalesRepository;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public $productRepository;
    public $categoryRepository;
    public $salesRepository;

    public function __construct(ProductsRepository $repository, CategoriesRepository $repositoryCat, 
          SalesRepository $repositorySales
    )
    {
         $this->productRepository = $repository;          
         $this->categoryRepository = $repositoryCat;
         $this->salesRepository = $repositorySales;
    }

    public function Homepage()
    {
        if ( ! Auth::check() )
        {
             return view('/login');
        }

     $products = $this->productRepository->getProducts();
     $latestProducts = $this->productRepository->latest();
     $categories = $this->categoryRepository->getCategories();
     $sales = $this->salesRepository->getSales();
     $earnings = CurrencyFormatHelper::currency_format($this->productRepository->getTotalSales());
     
     $dataForReport = ['products', 'latestProducts', 'categories', 'sales', 'earnings'];

        return view('home', compact($dataForReport));
    }

    public function Login()
    {
        if ( Auth::check() )
        {
             return redirect('/');     
        }
        
        return view('Login');
    }

    public function Register()
    {
         if ( Auth::check() )
         {
              return redirect('/');
         }

         return view('Register');
    }

    public function Statistics()
    {
         if ( ! Auth::check() )
         {
              return redirect('/');
         }
         
         return view('statistics');
    }

    public function getProductSales()
    {
          $productSales = $this->productRepository->getProductSales();

          return response($productSales, 200);
    }

}
