<?php

namespace App\Http\Controllers\api;

use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(UserUpdateRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();
        $model = User::where('email', $user->email);

        $model->email = $validated['email'];
        $model->phone = $validated['phone'];
        $model->save();

        //TO DO: Implement send email OTP

        return SendResponse::handle($user, 'email berhasil diubah');
    }

    public function updatePassword()
    {

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
}
