<?php

namespace App\Http\Controllers\api\market;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantStoreRequest;
use App\Http\Resources\MerchantCollection;
use App\Models\Merchant;
use Illuminate\Http\Request;
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

    public function index()
    {
        //TO DO: merchant that is not approved yet should not be returned
        $merchants = Merchant::all();

        return new MerchantCollection($merchants);
    }

    public function showByMerchant(Request $request)
    {
        $user = $request->user();
        $resident = $user->userable;
        $merchant = $resident->merchant;

        return SendResponse::handle($merchant, 'Permintaan berhasil');
    }

    public function show($merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);

        return SendResponse::handle($merchant, 'Permintaan berhasil');
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
     * used by admin to approve merchant
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
