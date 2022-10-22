<?php

namespace App\Actions;

class SendResponse
{
    public static function handle($data, $message)
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function error($message)
    {
        return response()->json([
            'status' => 500,
            'success' => false,
            'message' => $message,
            'data' => '',
        ]);
    }
}
