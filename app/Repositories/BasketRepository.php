<?php

namespace App\Repositories;

use App\Models\Basket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketRepository
{

    public $model;

    public function __construct() {
        $this->model = new Basket();
    }

    public function listBasket() {
        $id = Auth::user()->id;

        $basketItens = $this->model->where('user_id', $id)->get();

        $basketItens = $basketItens->map(function($item, $key) {
                $item['price'] = $item->product->price * $item->quantity;
                return $item;
        });

        return $basketItens;
    }

    public function postProductBasket(Request $request) {
        $id = Auth::user()->id;

        $productBasket = $this->model->where('product_id',$request->product)->first();

        if ( $productBasket ) {
            $productBasket->quantity = $productBasket->quantity+1;
            $productBasket->save();

            return $productBasket;
        }

        return $this->model->create([
            'user_id' => $id,
            'product_id' => $request->product,
            'quantity' => $request->quantity
        ]);

    }

    public function updateProductBasket(Request $request,$id) {
        $productBasket = $this->model->findOrFail($id);
    
        $productBasket->fill($request->all());
        $productBasket->save();

        return $productBasket;
    }

    public function removeProduct($id) {
        $basket = $this->model->findOrFail($id);

        return $basket->delete();
    }

    public function getBasketItens() {
        $items = $this->model->where('user_id', Auth::user()->id)
               ->select(['user_id','product_id','quantity'])
               ->get()->toArray();

        $now = Carbon::now();

        foreach ($items as &$item) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
        }
        
       return $items;
    }

    public function clearBasket() {
        return $this->model::truncate();
    }
}