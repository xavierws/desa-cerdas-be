<?php

namespace App\Http\Controllers\api;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantStoreRequest;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function store(MerchantStoreRequest $request)
    {
        $user = $request->user();
        $resident = $user->userable;
        $validated = $request->validated();

        $merchant = Merchant::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'province' => $validated['province'],
            'postal_code' => $validated['postal_code'],
            'is_approved' => false,
            'resident_id' => $resident->id,
        ]);

        return SendResponse::handle($merchant, 'Toko berhasil dibuat');
    }
}
