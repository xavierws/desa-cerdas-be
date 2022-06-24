<?php

namespace App\Http\Controllers\api;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function store(AdminStoreRequest $request)
    {
        if ($request->user()->role_name !== 'super_admin') {
            throw ValidationException::withMessages([
                'role' => ['role harus super admin']
            ]);
        }
        $validated = $request->validated();

        $admin = Admin::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'nik' => $validated['nik'],
            'occupation' => $validated['occupation'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role_id' => 2,
            'userable_id' => $admin->id,
            'userable_type' => 'App\Models\Admin',
        ]);

        return SendResponse::handle($user, 'Admin berhasil dibuat');
    }
}
