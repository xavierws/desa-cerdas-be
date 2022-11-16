<?php

namespace App\Http\Controllers\api\market;

use App\Actions\SendResponse;
use App\Actions\StoreImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

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

        $imageUrl = StoreImage::handle($validated['base64_image'], 'product/', $product->id);
        $image = ProductImage::create([
            'url' => $imageUrl,
            'product_id' => $product->id,
        ]);

        return SendResponse::handle($product, 'Produk berhasil dibuat');
    }

    public function index(Request $request, $merchantId)
    {
        $products = Product::with('image')
            ->where('merchant_id', $merchantId)->get();

        return new ProductCollection($products);
    }

    public function show()
    {

    }

    public function update(ProductStoreRequest $request, $productId)
    {
        $user = $request->user();
        $merchant = $user->userable->merchant;
        $validated = $request->validated();

        $product = Product::findOrFail($productId);

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        $product->description = $validated['description'];
        $product->save();

        return SendResponse::handle($product, 'produk berhasil diubah');
    }
}
