<?php

namespace App\Repositories;

use App\Models\Sales;
use Illuminate\Support\Facades\Auth;

class SalesRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Sales();
    }

    public function getSales()
    {
        if ( empty(Auth::user()->id) )
            return abort(404);

        return  Sales::all()->count();
    }
}