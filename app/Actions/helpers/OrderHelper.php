<?php

namespace App\Actions\helpers;

class OrderHelper
{
    public const Status = [
        'UNPAID' => 'unpaid',
        'WAITING_APPROVAL' => 'waitingApproval',
        'DELIVERING' => 'delivering',
        'DELIVERED' => 'delivered',
        'FAILED' => 'failed',
    ];
}
