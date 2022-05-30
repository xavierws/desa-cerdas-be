<?php

namespace App\Http\Controllers\api\market;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        $user = $request->user();
        $merchant = $user->userable->merchant;
        $validated = $request->validated();

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'merchant_id' => $merchant->id,
        ]);

        return SendResponse::handle($product, 'Produk berhasil dibuat');
    }

    public function index()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }
}
