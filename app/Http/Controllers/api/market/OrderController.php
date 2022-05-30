<?php

namespace App\Http\Controllers\api\market;

use App\Actions\helpers\OrderHelper;
use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $resident = $user->userable;

        $order = Order::create([
            'price' => $validated['price'],
            'status' => OrderHelper::Status['WAITING_APPROVAL'],
            'resident_id' => $resident->id,
            'merchant_id' => $validated['merchant_id'],
        ]);

        foreach ($validated['items'] as $item) {
            Cart::create([
                'quantity' => $item['quantity'],
                'product_id' => $item['product_id'],
                'order_id' => $order->id,
            ]);
        }

        return SendResponse::handle($order, 'Order berhasil dibuat');
    }

    public function approveOrder()
    {

    }

    public function refuseOrder()
    {

    }
}
