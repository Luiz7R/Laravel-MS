<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
      public $repository;
      
      public function __construct(UsersRepository $repository)
      {
          $this->repository = $repository;
      }
      
      public function register(RegisterRequest $request)
      {
          $user = $this->repository->register($request->validated());

          Auth::login($user);

          return redirect()->route('msHome');
      }
}
