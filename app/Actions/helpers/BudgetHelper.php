<?php

namespace App\Actions\helpers;

class BudgetHelper
{
    public const DiagramColor = [
        "#ea5545",
        "#f46a9b",
        "#ef9b20",
        "#edbf33",
        "#ede15b",
        "#bdcf32",
        "#87bc45",
        "#27aeef",
        "#b33dc6",
    ];

    public static function idCategory($category)
    {
        if ($category === 'pendapatan') {
            $categoryId = 1;
        } elseif ($category === 'belanja') {
            $categoryId = 2;
        } else {
            $categoryId = 3;
        }

        return $categoryId;
    }

    public static function countPercentage($cost, $count)
    {
        return ($cost / $count) * 100;
    }
}
