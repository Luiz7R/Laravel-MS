<?php

namespace App\Repositories;

use App\Models\Sales;
use App\Repositories\BasketRepository;
use Illuminate\Support\Facades\Auth;

class SalesRepository
{
    private $model;
    private $basketRepository;

    public function __construct()
    {
        $this->model = new Sales();

        $this->basketRepository = new BasketRepository;

    }

    public function getSales()
    {
        if ( empty(Auth::user()->id) )
            return abort(404);

        return  Sales::all()->count();
    }

    public function finalizeTransaction($itens) {
        $transaction = Sales::insert($itens);

        if ( $transaction ) {
            $this->basketRepository->clearBasket();
        }
    }
}