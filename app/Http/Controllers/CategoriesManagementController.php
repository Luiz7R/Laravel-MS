<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesManagementController extends Controller
{
    public $repository;
    
    public function __construct(CategoriesRepository $repository)
    {
         $this->repository = $repository;
    }

    public function manageCategories()
    {
        $categories = $this->repository->getCategories();  

        return view('manageCategories', compact('categories'));
    }

    public function getCategory($categoryId)
    {
         $category = $this->repository->getCategory($categoryId);

         return $category;
    } 

    public function getCategories()
    {
        $categories = $this->repository->getCategories();  
        
        return $categories;
    }


    public function postCategory(Request $request)
    {
          $this->repository->postCategory($request);

          return redirect()->route('categoriesPage'); 
    }

    public function updateCategory(Request $request, $categoryId)
    {
        $this->repository->updateCategory($request, $categoryId);

        return true;
    }

    public function deleteCategory($categoryId): bool
    {
         $this->repository->deleteCategory($categoryId);     
     
         return true;
    }

}
