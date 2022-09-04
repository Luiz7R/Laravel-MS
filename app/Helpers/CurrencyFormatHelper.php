<?php

namespace App\Helpers;

class CurrencyFormatHelper
{
    public static function currency_format($amount)
    {
        return 'R$ ' . number_format($amount, 2);
    }
    
}