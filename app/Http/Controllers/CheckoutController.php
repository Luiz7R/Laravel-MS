<?php

namespace App\Http\Controllers;

use App\Repositories\BasketRepository;
use App\Repositories\SalesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public $repository;
    public $salesRepository;

    public function __construct (
        BasketRepository $repository,
        SalesRepository $salesRepository
    ) {
        $this->repository = $repository;
        $this->salesRepository = $salesRepository;
    }

    public function checkoutPage(Request $request) {
        if ( ! Auth::user() )
            return redirect()->route('msPageLogin');

        if ( !$request->has('fromBasketPage') )
             return redirect()->route('listBasket');

        $checkoutItens = $this->repository->listBasket();
        $total = $checkoutItens->sum('price');
 
        return view('layouts.checkout.checkout', compact('checkoutItens','total'));
    }

    public function completeSale(Request $request) {
        $itens = $this->repository->getBasketItens();
        $this->salesRepository->finalizeTransaction($itens);

        return redirect()->route('msHome');
    }
}
