<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    public $repository;
    public function __construct(CategoriesRepository $repository)
    {
         $this->repository = $repository;
    }

    public function getCategories()
    {
        $categories = $this->repository->getCategories();  

        return $categories;
    }

    public function categoriesPage()
    {
        $categories = $this->repository->getCategories();  

        return view('categories', compact('categories'));
    }
}
