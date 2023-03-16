<?php

namespace App\Helpers;

class CurrencyFormatHelper
{
    public static function currency_format($amount)
    {
        return '$ ' . number_format($amount, 2, ',', '.');

    }
    
}