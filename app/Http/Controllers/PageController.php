<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public $repository;
    public $repositoryCat;

    public function __construct(ProductsRepository $repository, CategoriesRepository $repositoryCat)
    {
         $this->repository = $repository;          
         $this->repositoryCat = $repositoryCat;
    }

    public function Homepage()
    {
        if ( ! Auth::check() )
        {
             return view('/login');    
        }

        $categories = $this->repositoryCat->getCategories();
        $products = $this->repository->getProducts();
        $latestProducts = $this->repository->latest();
        $sales = Sales::all();

        return view('home', compact('categories', 'products', 'latestProducts', 'sales'));
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

    public function jsonProductSales()
    {
          $salesProduct = array();
          $cont = 0;

          foreach( Product::all() as $key => $product )
          {
               $salesQuantity = $this->getProductSales($product->id);

               if ( $salesQuantity > 0 )
               {
                    $salesProduct[$cont]["name"] = $product->name;
                    $salesProduct[$cont]["salesQuantity"] = $salesQuantity; 
                    $cont++;                   
               }
          }

          return response()->json($salesProduct, 200, [], JSON_FORCE_OBJECT); 
    }

    public function getProductSales($productId)
    {
          return Sales::select('*')->where('product_id',$productId)
                      ->get()->count();       
    }

}
