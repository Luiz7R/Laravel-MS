<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function register (array $data)
    {
           $data['password'] = Hash::make($data['password']);
           $data['remember_token'] = Str::random(10);

           return $this->model->create($data);
    }
}