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

    public static function pickDiagramColor($i)
    {
        if ($i > count(self::DiagramColor)-1) {
            return self::DiagramColor[$i-count(self::DiagramColor)];
        }

        return self::DiagramColor[$i];
    }

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

    public static function countTotalCost($budgets)
    {
        $totalCost = 0;
        foreach ($budgets as $budget) {
            $totalCost += $budget['cost'];
        }
        return $totalCost;
    }
}
