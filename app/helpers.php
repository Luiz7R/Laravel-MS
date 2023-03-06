<?php

if (! function_exists('currency_format')) {
    function currency_format($amount)
    {
        return 'R$ ' . number_format($amount, 2, ',', '.');
    }
}