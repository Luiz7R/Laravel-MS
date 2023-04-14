<?php

namespace App\Repositories;

use App\Models\Basket;
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

        return $this->model->where('user_id', $id)->get();
    }

    public function postProductBasket(Request $request) {
        $id = Auth::user()->id;

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
}