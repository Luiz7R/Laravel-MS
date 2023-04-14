<?php

namespace App\Http\Controllers;

use App\Repositories\BasketRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public $repository;

    public function __construct(BasketRepository $repository) {
        $this->repository = $repository;
    }

    public function listBasket() {

        if ( ! Auth::user() )
            return redirect()->route('msPageLogin');

        $basketItems = $this->repository->listBasket();

        return view('layouts.basket.basket', compact('basketItems'));
    }

    public function postProductBasket(Request $request) {
        $productBasket = $this->repository->postProductBasket($request);

        if ( $productBasket ) {
            return redirect()->route('listBasket');
        }
    }

    public function updateProductBasket(Request $request,$productId) {

        $productBasket = $this->repository->updateProductBasket($request,$productId);

        if ( $productBasket ) {
            return response()->json(['msg' => 'Updated Sucessfully'], 204);
        }
    }

    public function removeProduct($id) {
        return $this->repository->removeProduct($id);
    }
}
