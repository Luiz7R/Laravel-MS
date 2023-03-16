<?php

if (! function_exists('currency_format')) {
    function currency_format($amount)
    {
        return '$ ' . number_format($amount, 2, '.', ',');
    }
}