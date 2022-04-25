<?php

namespace App\Http\Controllers\api\auth;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function generateToken(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah'],
            ]);
        }

        $token = $user->createToken($validated['device_name'])->plainTextToken;
        $data = [
            'token' => $token
        ];

        return SendResponse::handle($data, 'Login berhasil');
    }

    public function show()
    {

    }

    public function destroy()
    {

    }
}
