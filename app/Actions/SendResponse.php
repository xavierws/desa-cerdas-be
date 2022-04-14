<?php

namespace App\Actions;

class SendResponse
{
    public static function handle($data, $message)
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
