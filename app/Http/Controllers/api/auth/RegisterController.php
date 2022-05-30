<?php

namespace App\Http\Controllers\api\auth;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        $resident = Resident::create([
            'name' => $validated['name'],
            'nik' => $validated['nik'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'province' => $validated['province'],
            'postal_code' => $validated['postal_code'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role_id' => 1,
            'userable_id' => $resident->id,
            'userable_type' => 'App\Models\Resident'
        ]);

        return SendResponse::handle($user, 'Account berhasil dibuat');
    }
}
