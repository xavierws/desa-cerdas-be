<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create(RegisterRequest $request)
    {
        $validated = $request->validated();


    }
}
