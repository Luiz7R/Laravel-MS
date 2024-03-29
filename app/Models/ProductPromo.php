<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPromo extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'promo_price',
        'user_id',
        'product_id',
        'category_id',
        'start_date_promo',
        'end_date_promo'
    ];  

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
