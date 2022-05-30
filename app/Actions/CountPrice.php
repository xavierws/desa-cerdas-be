<?php

namespace App\Actions;

use App\Models\Product;

class CountPrice
{
    public static function handle($items)
    {
        $price = 0;
        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);

            $price += $product->price;
        }

        return $price;
    }
}
