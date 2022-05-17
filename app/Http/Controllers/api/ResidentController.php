<?php

namespace App\Http\Controllers\api;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResidentUpdateRequest;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResidentController extends Controller
{
    public function update(ResidentUpdateRequest $request)
    {
        $user = $request->user();
        if ($user->role !== 'resident') {
            throw ValidationException::withMessages([
                'role' => ['role harus resident']
            ]);
        }

        $validated = $request->validated();
        $resident = $user->userable;
        $resident->name = $validated['name'];
        $resident->nik = $validated['nik'];
        $resident->address = $validated['address'];
        $resident->city = $validated['city'];
        $resident->province = $validated['province'];
        $resident->postal_code = $validated['postal_code'];
        $resident->save();

        return SendResponse::handle($resident,'Data berhasil diubah');
    }
}
