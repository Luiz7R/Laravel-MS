<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductPromo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProductsManagementRepository
{
    private $model;
    private $promoProduct;

    public function __construct()
    {
        $this->model = new Product();
        $this->promoProduct = new ProductPromo();
    }

    public function postProduct(Request $request)
    {
        return $this->model->create([
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);  
    }

    public function postPromoProduct(Request $request)
    {
        return $this->promoProduct->create([
            'promo_price' => $request->product_promo_price,
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'category_id' => $request->category_id,
            'start_date_promo' => $request->start_date_promo,
            'end_date_promo' => $request->end_date_promo,
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

    public function getProductsWithoutPromo()
    {   
        $allProductsPromo = $this->promoProduct->pluck('product_id')->all(); 
        return $this->model->whereNotIn('id', $allProductsPromo)->get();
    }

    public function getPromoProducts()
    {   
        $ActualDateTime = now('America/Sao_Paulo')->format('Y-m-d H:i:s');
        return $this->promoProduct->where('end_date_promo', '>=', $ActualDateTime)->get();
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
        
        return  $this->model->where('user_id', Auth::user()->id)->find($productId)->delete(); 
    }

    public function getProductSales(): Collection
    {
        $products =  $this->model->withCount('sales')->get();
        collect($products)->map(function ($product) {
            if ($product->sales_count) {
                $product->sales = $product->sales_count;
                $product->total = floatval($product->price) * $product->sales;
            }
        });

        $products = $products->filter(function ($product) {
            return $product->sales_count > 0;
        });
        return $products;
    }

    public function getTotalSales(): float
    {
        $products =  $this->model->withCount('sales')->get();
    
        $totalSales = $products->sum(function ($product) {
            if ($product->sales_count) {
                return floatval($product->price) * $product->sales_count;
            }
            return 0;
        });
    
        return $totalSales;
    }

    public function getTennisProducts()
    {   
        return $this->model->where('category_id',2)->get(); 
    }

    public function getSlipperProducts()
    {   
        return $this->model->where('category_id',1)->get(); 
    }
}