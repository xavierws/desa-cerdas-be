<?php

namespace App\Http\Controllers\api;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function update(UserUpdateRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();
        $model = User::where('email', $user->email)->first();

        $model->email = $validated['email'];
        $model->phone = $validated['phone'];
        $model->save();

        //TO DO: Implement send email OTP

        return SendResponse::handle($user, 'email berhasil diubah');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $model = User::where('email', $user->email)->first();

        if (Hash::check($request->password, $model->password)) {
            throw ValidationException::withMessages([
                'password' => ['password salah']
            ]);
        }

        if ($request->new_password !== $request->password_validation) {
            throw ValidationException::withMessages([
                'new_password' => ['password tidak sama dengan konfirmasi passsword']
            ]);
        }

        $model->password = Hash::make($request->new_password);
        $model->save();

        return SendResponse::handle($user, 'Passoword berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        $deleted = User::where('email', $user->email)->delete();
        $data = [
            'deleted' => $deleted,
            'user' => $user
        ];

        return SendResponse::handle($data, 'User berhasil dihapus');
    }

    public function resetPassword()
    {

    }
}
