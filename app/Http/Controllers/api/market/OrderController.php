<?php

namespace App\Http\Controllers\api\market;

use App\Actions\helpers\OrderHelper;
use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

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

    public function acceptOrder(Request $request)
    {
        $order = Order::findOrFail($request->query('order_id'));

        $order->status = OrderHelper::Status['ACCEPTED'];
        $order->save();

        return SendResponse::handle($order, 'Order diterima');
    }

    public function rejectOrder(Request $request)
    {
        $order = Order::findOrFail($request->query('order_id'));

        $order->status = OrderHelper::Status['FAILED'];
        $order->save();

        return SendResponse::handle($order, 'Order ditolak');
    }

    public function finishOrder(Request $request)
    {
        $order = Order::findOrFail($request->query('order_id'));

        $order->status = OrderHelper::Status['DELIVERED'];
        $order->save();

        return SendResponse::handle($order, 'Order selesai');
    }

    public function indexByMerchant($merchantId)
    {
        $orders = Order::where('merchant_id', $merchantId)->get();

        return new OrderCollection($orders);
    }

    public function indexByResident($residentId)
    {
        $orders = Order::where('resident_id', $residentId)->get();

        return new OrderCollection($orders);
    }

    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);

        return SendResponse::handle($order, 'Permintaan Berhasil');
    }
}
