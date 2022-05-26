<?php

namespace App\Http\Controllers\api\market;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantStoreRequest;
use App\Models\Merchant;
use Illuminate\Http\Client\Request;
use Illuminate\Validation\ValidationException;

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

    public function update(MerchantStoreRequest $request)
    {
        $user = $request->user();
        $resident = $user->userable;
        $merchant = $resident->merchant;
        $validated = $request->validated();

        $merchant->name = $validated['name'];
        $merchant->address = $validated['address'];
        $merchant->city = $validated['city'];
        $merchant->province = $validated['province'];
        $merchant->postal_code = $validated['postal_code'];
        $merchant->save();

        return SendResponse::handle($merchant, 'Data berhasil diubah');
    }

    public function destroy()
    {

    }

    /**
     * use by admin to approve merchant
     *
     * @param Request $request
     * @param $merchantId
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function approve(Request $request, $merchantId)
    {
        $user = $request->user();
        if ($user->role !== 'admin') {
            throw ValidationException::withMessages([
                'role' => ['role harus admin'],
            ]);
        }

        $merchant = Merchant::findOrFail($merchantId);
        $merchant->is_approved = true;
        $merchant->save();

        return SendResponse::handle($merchant, 'toko berhasil disetujui');
    }
}
