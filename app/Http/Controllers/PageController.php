<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyFormatHelper;
use App\Http\Resources\ProductResource;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsManagementRepository;
use App\Repositories\SalesRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public $productRepository;
    public $categoryRepository;
    public $salesRepository;

    public function __construct(ProductsManagementRepository $repository, CategoriesRepository $repositoryCat, 
          SalesRepository $repositorySales
    )
    {
         $this->productRepository = $repository;          
         $this->categoryRepository = $repositoryCat;
         $this->salesRepository = $repositorySales;
    }

    public function HomepageA()
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


    public function Homepage() 
    {
        if ( ! Auth::check() ) 
        {
            return view('/login');
        }
        $products = $this->productRepository->getProducts();
        $productPromotion = $this->productRepository->getPromoProducts();
        $mostSales = $this->productRepository->getProductSales();

        $categories = $this->categoryRepository->getCategories();
        $latestProducts = $this->productRepository->latest();

        $dataForReport = ['products', 'categories', 'mostSales', 'latestProducts', 'productPromotion'];

        return view('homeclient', compact($dataForReport));


    }
    public function Login()
    {
        if ( Auth::check() )
        {
             return redirect('/');     
        }
        
        return view('login');
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
          return new Response(new ProductResource($productSales), 200);
    }

}
