<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;

class CategoriesManagementController extends Controller
{
    public function __construct(CategoriesRepository $repository)
    {
         $this->repository = $repository;
    }

    public function getCategories()
    {
        $categories = $this->repository->getCategories();  
        
        return $categories;
    }

}
