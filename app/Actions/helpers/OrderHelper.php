<?php

namespace App\Actions\helpers;

class OrderHelper
{
    public const Status = [
        'UNPAID' => 'unpaid',
        'WAITING_APPROVAL' => 'waitingApproval',
        'ACCEPTED' => 'accepted',
        'DELIVERING' => 'delivering',
        'DELIVERED' => 'delivered',
        'COMPLETED' => 'completed',
        'FAILED' => 'failed',
    ];
}
