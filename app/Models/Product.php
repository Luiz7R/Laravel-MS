<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'user_id',
        'category_id'
    ];  
    
    public function sales()
    {
        return $this->hasMany(Sales::class);      
    }

    public function getProductSales()
    {
        return $this->sales()->count();      
    }

    public function promo()
    {
        return $this->hasOne(ProductPromo::class);
    }
}